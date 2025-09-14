<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view("admin.category.index", ["category" => Category::all()]);
    }

    public function add(Request $request)
    {
        return view("admin.category.add");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        $category = new Category;
        $category->category_name = $request->name;
        $category->save();
        return redirect('admin/category')->with('msg', 'Category Added!!!');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit',["category"=> $category]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $category = Category::where('id', $id)->first();
        $category->category_name = $request->name;
        $category->save();
        return redirect('admin/category')->with('msg','Category Updated!!!');
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->first();
        $category->delete();
        return redirect('admin/category')->with('msg','Category Deleted');
    }

    public function toggle($id)
    {
        $category = Category::where('id', $id)->first();
        if($category->status == 1){
            $category->status = 0;
            $category->save();
        }else if($category->status == 0){
            $category->status = 1;
            $category->save();
        }
        return redirect('admin/category')->with('msg','Category Status updated');
    }
}
