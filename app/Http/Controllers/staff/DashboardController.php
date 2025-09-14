<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\bill;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalProducts = Product::count();
        $totalInvoice = Bill::count();
        $todayInvoice = Bill::select('amount');
        return view("staff.dashboard", compact("totalProducts","totalInvoice","todayInvoice"));
    }
}