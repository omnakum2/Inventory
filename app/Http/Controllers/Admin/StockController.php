<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\product;
use App\Models\wharehouse;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        //$stock = DB::table('stock')->select('stock.id','stock.product_code','stock.quantity','stock.wharehouse','wharehouse.name')->join('wharehouse','wharehouse.id','=','stock.wharehouse')->get();
        //dd($stock);
        $stock = Stock::all();
        return view("admin.stock.index", compact('stock'));
    }

    public function add(Request $request)
    {
        $product = Product::all();
        $wharehouse = Wharehouse::all();
        return view("admin.stock.add", compact('product', 'wharehouse'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "quantity" => "required",
            "wharehouse" => "required",
            "product_code" => "required",
        ]);

        $stock = new Stock;
        $stock->quantity = $request->quantity;
        $stock->wharehouse_id = $request->wharehouse;
        $stock->product_code = $request->product_code;
        $stock->save();
        return redirect('admin/stock')->with('msg', 'Stock Added!!!');
    }

    public function edit($id)
    {
        $product = Product::all();
        $wharehouse = Wharehouse::all();
        $stock = Stock::findOrFail($id);
        //dd($wharehouse);
        return view('admin.stock.edit',["stock"=> $stock],compact('product','wharehouse'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "quantity" => "required",
            "wharehouse" => "required",
            "product_code" => "required",
        ]);

        $stock = Stock::findOrFail($id);
        $stock->quantity = $request->quantity;
        $stock->wharehouse_id = $request->wharehouse;
        $stock->product_code = $request->product_code;
        $stock->save();
        return redirect('admin/stock')->with('msg','Stock Updated!!!');
    }

    public function delete($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect('admin/stock')->with('msg','Stock Deleted');
    }
}
