<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\user;
use App\Models\bill;
use App\Models\product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalStaff = User::where('role_as',0)->count();
        $totalInvoice = Bill::count();
        $totalProduct = Product::count();
        return view("admin.dashboard", compact("totalStaff","totalInvoice","totalProduct"));
    }
}
