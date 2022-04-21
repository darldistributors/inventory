<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;


class ProductController extends Controller
{
    public function index()
    {
        $data['settings'] = Settings::where('id', '<', 10)->first();
        $data['products'] = Product::all();
        return view('admin.register-product', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'productName' => ['required', 'string', 'max:255'],
            // 'reg_by' => ['required', 'string', 'max:255'],
            'unitCost' => ['required'],
            'companyName' => ['required', 'string', 'max:255'],
            'companyAddress' => ['required', 'string', 'max:255'],
            'supplierName' => ['required', 'string', 'max:255'],
            'supplierPhone' => ['required', 'string', 'max:255']
        ]);

        $user = Product::create([
            'name' => $request->productName,
            'reg_by' => Auth::user()->id,
            'unit_cost' => $request->unitCost,
            'supplier_name' => $request->companyName,
            'supplier_phone' => $request->supplierPhone,
            'comapnay_name' => $request->supplierName,
            'company_address' => $request->companyAddress
        ]);

        return back()->with('success', 'Registration successful.');
    }

    public function inventory(){
        $data['inventory'] = Product::all();
        $data['settings'] = Settings::where('id', '<', 10)->first();
        return view('admin.inventory', $data);
    }

    public function editInventory(Request $request){
        $request->validate([
            'product_id' => ['required'],
            'selling_price' => ['required'],
            'product_quantity' => ['required'],
            'out_of_stock' => ['required']
        ]);

    
        Product::where('id', $request->product_id)
          ->update([
              'selling_price' => $request->selling_price,
              'in_stock' => $request->product_quantity,
              'out_of_stock' => ($request->out_of_stock === 'on') ? false : true
            ]);

        return back()->with('success', 'Inventory updated successfully');
    }
}
