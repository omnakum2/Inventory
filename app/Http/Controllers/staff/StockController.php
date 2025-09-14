<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\stock;
use App\Models\product;

class StockController extends Controller
{
    public function index(){
        $stock = Stock::all();
        return view('staff.stock.index',compact('stock'));
    }

    public function detail($id){
        $product = Product::where('code', $id)->first();
        return view('staff.stock.detail',compact('product'));
    }
}
