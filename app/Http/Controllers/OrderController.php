<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Expense;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;


class OrderController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        $data['orders'] = Order::all();
        $data['suppliers'] = Product::distinct()->get(['supplier_name', 'supplier_phone']);
        $data['settings'] = Settings::where('id', '<', 10)->first();
        return view('admin.placeOrderForm', $data);
    }

    public function confirmOrderPage()
    {
        $data['settings'] = Settings::where('id', '<', 10)->first();
        $data['unconfirmedOrders'] = Order::all()->where('confirmed_order', false);
        return view('admin.confirmOrder', $data);
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => ['required', 'string', 'max:255'],
            'orderQuantity' => ['required', 'string', 'max:255'],
            'orderDate' => ['required', 'string', 'max:255'],
            'product_name' => ['required', 'string', 'max:255'],
            'supplierName' => ['required', 'string', 'max:255'],
            'supplierPhone' => ['required', 'string', 'max:255'],
            'total' => ['required', 'string', 'max:255']
        ]);

        Order::create([
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'order_date' => date('Y-m-d', strtotime($request->orderDate)),
            'quantity' => $request->orderQuantity,
            'total' => $request->total,
            'supplier_name' => $request->supplierName,
            'supplier_phone' => $request->supplierPhone,
            'reg_by' => Auth::user()->id
        ]);

        return back()->with('success', 'Order placed successfully.');
    }

    public function orderConfirmed(Request $request){
        $request->validate([
            'confirmDate' => ['required']
        ]);

    
        Order::where('confirmed_order', false)
          ->where('id', $request->order_id)
          ->update([
              'discount' => $request->discount,
              'confirmed_order' => true, 
              'confirmed_by' => Auth::user()->id,
              'quantity' => $request->orderQuantity,
              'confirm_date' => date('Y-m-d', strtotime($request->confirmDate)),
            ]);
        
        //update product stocks
        Product::where('id', $request->product_id)
            ->update([
                'out_of_stock' => true,
                'in_stock' => DB::raw('in_stock + '.$request->orderQuantity)
        ]);
        
        if($request->expenses > 0){
            // if any expense incured
            Expense::create([
                'date' => date('Y-m-d', strtotime($request->confirmDate)),
                'expense_type' => 'order',
                'amount' => $request->expenses,
                'comment' => $request->comment,
                'incured_by' => Auth::user()->id,
                'reg_by' => Auth::user()->id
            ]);
        }
        
        return back()->with('success', 'Order received successfully');
    }
}
