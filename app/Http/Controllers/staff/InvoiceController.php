<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\bill;
use App\Models\bill_items;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('staff.invoice.index', compact('product'));
    }

    public function show()
    {
        $bill = Bill::all();
        return view('staff.invoice.show', compact('bill'));
    }

    public function detail($id)
    {
        $billdata = DB::table('bill')
            ->select('bill.id', 'bill.customer_name', 'bill.customer_phone', 'bill.amount', 'bill.created_at', 'bill_items.product_code', 'bill_items.product_price', 'bill_items.product_quantity', 'bill_items.total')
            ->join('bill_items', 'bill_items.bill_id', '=', 'bill.id')
            ->where('bill.id', $id)
            ->get();
        //dd($billdata);
        return view('staff.invoice.detail', compact('billdata'));
    }

    public function getFill(Request $request)
    {
        $id = $request->get('id');

        $product = DB::table('product')
            ->select('product.code', 'product.price', 'stock.product_code', 'stock.quantity')
            ->join('stock', 'stock.product_code', '=', 'product.code')
            ->where('code', $id)
            ->first();

        return $product;
    }

    public function getData(Request $request)
    {
        // get all data
        $data = $request->json()->all();

        // get invoice data
        $customerName = $data['cname'];
        $customerMob = $data['cmob'];
        $userId = $data['user'];
        $gtotal = $data['gtotal'];

        // //saving bill amount
        // $bill = new Bill;
        // $bill->user_id = $userId;
        // $bill->customer_name = $customerName;
        // $bill->customer_phone = $customerMob;
        // $bill->amount = $gtotal;
        // $bill->save();

        // // get invoice items
        // $bill_list = $data['billItems'];

        // //save the item list of bill
        // foreach ($bill_list as $row) {
        //     $bill_items = new Bill_items;
        //     $bill_items->product_code = $row['productName'];
        //     $bill_items->product_quantity = $row['quantity'];
        //     $bill_items->product_price = $row['price'];
        //     $bill_items->total = $row['quantity'] * $row['price'];
        //     $bill_items->bill_id = $bill->id;
        //     $bill_items->save();
        // }

        // return response()->json(['message' => 'Data saved...']);


        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Saving bill amount
            $bill = new Bill;
            $bill->user_id = $userId;
            $bill->customer_name = $customerName;
            $bill->customer_phone = $customerMob;
            $bill->amount = $gtotal;
            $bill->save();

            // Get invoice items
            $bill_list = $data['billItems'];

            // Save the item list of the bill and update stock
            foreach ($bill_list as $row) {
                $bill_items = new Bill_items;
                $bill_items->product_code = $row['productName'];
                $bill_items->product_quantity = $row['quantity'];
                $bill_items->product_price = $row['price'];
                $bill_items->total = $row['quantity'] * $row['price'];
                $bill_items->bill_id = $bill->id;
                $bill_items->save();

                // Update stock quantity
                $product_code = $row['productName'];
                $quantity_sold = $row['quantity'];

                // Decrease stock quantity
                DB::table('stock')
                    ->where('product_code', $product_code)
                    ->decrement('quantity', $quantity_sold);
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Data saved...']);
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollBack();

            // Log the error or handle it appropriately
            return response()->json(['error' => 'Failed to save data: ' . $e->getMessage()], 500);
        }
    }
}
