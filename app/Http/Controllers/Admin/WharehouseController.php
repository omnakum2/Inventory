<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wharehouse;

class WharehouseController extends Controller
{
    public function index()
    {
        return view("admin.wharehouse.index", ["wharehouse" => Wharehouse::all()]);
    }

    public function add(Request $request)
    {
        return view("admin.wharehouse.add");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        $wharehouse = new Wharehouse;
        $wharehouse->name = $request->name;
        $wharehouse->save();
        return redirect('admin/wharehouse')->with('msg', 'Wharehouse Added!!!');
    }

    public function edit($id)
    {
        $wharehouse = Wharehouse::where('id', $id)->first();
        return view('admin.wharehouse.edit',["wharehouse"=> $wharehouse]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $wharehouse = Wharehouse::where('id', $id)->first();
        $wharehouse->name = $request->name;
        $wharehouse->save();
        return redirect('admin/wharehouse')->with('msg','Wharehouse Updated!!!');
    }

    public function delete($id)
    {
        $wharehouse = Wharehouse::where('id', $id)->first();
        $wharehouse->delete();
        return redirect('admin/wharehouse')->with('msg','Wharehouse Deleted');
    }

    public function toggle($id)
    {
        $wharehouse = Wharehouse::where('id', $id)->first();
        if($wharehouse->status == 1){
            $wharehouse->status = 0;
            $wharehouse->save();
        }else if($wharehouse->status == 0){
            $wharehouse->status = 1;
            $wharehouse->save();
        }
        return redirect('admin/wharehouse')->with('msg','Wharehouse Status updated');
    }
}
