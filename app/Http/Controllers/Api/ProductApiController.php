<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductApiController extends Controller
{
    public function index()
    {
        $product = DB::table('product')
            ->select('product.id', 'product.code', 'product.name', 'product.description', 'product.category_id', 'category.category_name', 'product.brand_id', 'brand.brand_name', 'product.price')
            ->join('brand', 'brand.id', '=', 'product.brand_id')
            ->join('category', 'category.id', '=', 'product.category_id')
            ->get();
        return response()->json([
            "status" => true,
            "msg" => "done...",
            "data" => $product
        ]);
    }
}
