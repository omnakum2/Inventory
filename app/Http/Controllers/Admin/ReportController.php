<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /** Month number (from SQLite strftime '%m') -> English month name. */
    private const MONTHS = [
        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
        5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
        9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December',
    ];

    public function index()
    {
        $monthlyData = $this->monthlyTotals();

        return view("admin.report.index", compact('monthlyData'));
    }

    public function detail($id)
    {
        if ($id == 1) {
            // Yearly total sales: strftime('%Y') instead of MySQL YEAR().
            $yearlyData = DB::table('bill')
                ->select(
                    DB::raw("strftime('%Y', created_at) as value"),
                    DB::raw('SUM(amount) as total_amount')
                )
                ->groupByRaw("strftime('%Y', created_at)")
                ->orderByRaw("strftime('%Y', created_at)")
                ->get();

            return response()->json(['data' => $yearlyData]);
        } elseif ($id == 0) {
            $monthlyData = $this->monthlyTotals()->map(fn ($row) => (object) [
                'value'        => $row->month_name,
                'total_amount' => $row->total_amount,
            ]);

            return response()->json(['data' => $monthlyData]);
        } else {
            return "error...";
        }
    }

    /**
     * Total sales amount per calendar month (SQLite-compatible).
     * Shared by the monthly report view and its JSON endpoint.
     */
    private function monthlyTotals(): Collection
    {
        return DB::table('bill')
            ->select(
                DB::raw("strftime('%m', created_at) as month_num"),
                DB::raw('SUM(amount) as total_amount')
            )
            ->groupByRaw("strftime('%m', created_at)")
            ->orderByRaw("strftime('%m', created_at)")
            ->get()
            ->map(fn ($row) => (object) [
                'month_name'   => self::MONTHS[(int) $row->month_num] ?? $row->month_num,
                'total_amount' => $row->total_amount,
            ]);
    }
}
