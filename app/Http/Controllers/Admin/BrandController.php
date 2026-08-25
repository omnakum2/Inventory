<?php

namespace App\Http\Controllers\Admin;

use App\Models\brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index(){
        return view("admin.brand.index",["brand"=>Brand::all()]);
    }

    public function add(Request $request)
    {
        return view("admin.brand.add");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        $brand = new Brand;
        $brand->brand_name = $request->name;
        $brand->save();
        return redirect('admin/brand')->with('msg', 'Brand Added!!!');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit',["brand"=> $brand]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $brand = Brand::findOrFail($id);
        $brand->brand_name = $request->name;
        $brand->save();
        return redirect('admin/brand')->with('msg','Brand Updated!!!');
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        if (DB::table('product')->where('brand_id', $id)->exists()) {
            return redirect('admin/brand')->with('msg', 'Cannot delete: brand is in use by products.');
        }
        $brand->delete();
        return redirect('admin/brand')->with('msg','Brand Deleted');
    }

    public function toggle($id)
    {
        $brand = Brand::findOrFail($id);
        if($brand->status == 1){
            $brand->status = 0;
            $brand->save();
        }else if($brand->status == 0){
            $brand->status = 1;
            $brand->save();
        }
        return redirect('admin/brand')->with('msg','Brand Status updated');
    }
}
