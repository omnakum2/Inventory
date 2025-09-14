<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewInvoiceApiController extends Controller
{
    public function getProducts()
    {
        $data = "hello";
        return response()->json($data);
    }
}
