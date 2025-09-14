<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            "status" => true,
            "msg" => "done...",
            "data" => $category
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

        Category::create([
            "name" => $request->name,
        ]);

        return response()->json([
            "status" => true,
            "msg" => "Category Added...",
            "data" => []
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('id', $id)->first();
        return response()->json([
            "status" => true,
            "msg" => "Category fetched...",
            "data" => $category
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

        $category = Category::where('id', $id)->first();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            "status" => true,
            "msg" => "Category updated...",
            "data" => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id', $id)->first();
        $category->delete();
        return response()->json([
            "status" => true,
            "msg" => "Category deleted...",
            "data" => []
        ]);
    }
}
