<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\brand;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view("admin.product.index",["product" => Product::all()]);
    }

    public function add(Request $request)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view("admin.product.add", compact('categories', 'brands'));
    }

    public function store(Request $request){
        $request->validate([
            "code" => "required",
            "name" => "required|string",
            "description" => "required|string",
            "category" => "required|integer",
            "brand" => "required|integer",
            "price" => "required",
        ]);

        $product = new Product;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->price = $request->price;
        $product->save();
        return redirect('admin/product')->with('msg', 'Product Added!!!');
    }
    public function detail($id){
        // $product = DB::table('product')
        // ->select('product.id','product.code','product.name','product.description','product.category_id','category.category_name','product.brand_id','brand.brand_name','product.price')
        // ->join('brand','brand.id','=','product.brand_id')
        // ->join('category','category.id','=','product.category_id')
        // ->first();
        //dd($product);
        $product = Product::where('id', $id)->first();
        return view('admin.product.detail',compact('product'));
    }
    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::where('id', $id)->first();
        //dd($categories);
        return view('admin.product.edit',compact('product','categories', 'brands'));
    }
    public function update(Request $request,$id){
        $request->validate([
            "code" => "required",
            "name" => "required|string",
            "description" => "required|string",
            "category" => "required|integer",
            "brand" => "required|integer",
            "price" => "required",
        ]);

        $product = Product::where('id', $id)->first();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->price = $request->price;
        $product->save();
        return redirect('admin/product')->with('msg', 'Product Updated!!!');
    }
    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect('admin/product')->with('msg','Product Deleted');
    }
    public function toggle($id)
    {
        $product = Product::where('id', $id)->first();
        if($product->status == 1){
            $product->status = 0;
            $product->save();
        }else if($product->status == 0){
            $product->status = 1;
            $product->save();
        }
        return redirect('admin/product')->with('msg','Product Status updated');
    }
}
