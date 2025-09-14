<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $monthlyData = DB::table('bill')
            ->select(
                DB::raw('MONTHNAME(created_at) as month_name'),
                DB::raw('SUM(amount) as total_amount')
            )
            ->groupBy(DB::raw('MONTHNAME(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
        //dd($monthlyData);
        return view("admin.report.index", compact('monthlyData'));
    }

    public function detail($id)
    {
        if ($id == 1) {
            $yearlyData = DB::table('bill')
                ->select(
                    DB::raw('YEAR(created_at) as value'),
                    DB::raw('SUM(amount) as total_amount')
                )
                ->groupBy(DB::raw('YEAR(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at)'))
                ->get();
            return response()->json(['data' => $yearlyData]);
        } elseif ($id == 0) {
            $monthlyData = DB::table('bill')
                ->select(
                    DB::raw('MONTHNAME(created_at) as value'),
                    DB::raw('SUM(amount) as total_amount')
                )
                ->groupBy(DB::raw('MONTHNAME(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();
            return response()->json(['data' => $monthlyData]);
        } else {
            return "error...";
        }
    }
}
