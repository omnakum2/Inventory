<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brand;

class BrandApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::all();
        return response()->json([
            "status" => true,
            "msg" => "done...",
            "data" => $brand
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        Brand::create([
            "name" => $request->name,
        ]);

        return response()->json([
            "status" => true,
            "msg" => "Brand Added...",
            "data" => []
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::where('id', $id)->first();
        return response()->json([
            "status" => true,
            "msg" => "Brand fetched...",
            "data" => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
        ]);

        $brand = Brand::where('id', $id)->first();
        $brand->name = $request->name;
        $brand->save();
        return response()->json([
            "status" => true,
            "msg" => "Brand updated...",
            "data" => $brand
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::where('id', $id)->first();
        $brand->delete();
        return response()->json([
            "status" => true,
            "msg" => "Brand deleted...",
            "data" => []
        ]);
    }
}