<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\DebtController as Debt;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use App\Models\ProductSales;


class SaleController extends Controller
{
    public function index($salesID_or_page = null, $items=null){

        if($salesID_or_page === 'held-receipt'){
            // if held receipt
            $data['sales'] = Sale::where(['on_hold'=>true])->get();
            $data['title'] = 'Held receipt';
            $data['cashiers'] = User::all()->sortDesc();
            $data['show_filter'] = false;
            $data['is_held'] = true;
            $data['settings'] = Settings::where('id', '<', 10)->first();
            return view('admin.sales', $data);
        }else if($salesID_or_page === 'all'){
            $from = (isset($_GET['start-date'])) ? htmlspecialchars($_GET['start-date']) : date('Y-m-d');
            $to = (isset($_GET['stop-date'])) ? htmlspecialchars($_GET['stop-date']) : date('Y-m-d');
            $cashier = (isset($_GET['cashier_id']) && $_GET['cashier_id'] !== 'all') ? htmlspecialchars($_GET['cashier_id']) : false;

            if($cashier !== false){
                $data['sales'] = Sale::whereBetween('created_at', [$from.' 00:00:00',$to.' 23:59:59'])
                  ->where('returned', false)
                  ->where('on_hold', false)
                  ->where('reg_by', $cashier)
                  ->limit(1000)
                  ->get()
                  ->sortDesc();
            }else {
                $data['sales'] = Sale::whereBetween('created_at', [$from.' 00:00:00',$to.' 23:59:59'])
                  ->where('returned', false)
                  ->where('on_hold', false)
                  ->limit(1000)
                  ->get()
                  ->sortDesc();
            }
            $data['cashiers'] = User::all()->sortDesc();
            $data['settings'] = Settings::where('id', '<', 10)->first();
            $data['title'] = 'ALL SALES';
            $data['show_filter'] = true;


            return view('admin.sales', $data);
        }

        $data['products'] = $this->getSellableProducts();
        $data['heldSale'] = Sale::where('id', $salesID_or_page)->first();
        $data['heldProducts'] = ProductSales::where('sale_id', $data['heldSale']->sales_id ?? '')->get();
        $data['settings'] = Settings::where('id', '<', 10)->first();
       
        return view('admin.make-sales', $data);
    }

    public static function salesSummary($reports, $val){
        $revenue = 0;
        $profit = 0;
        $debt= 0;
        $discount = 0;
        $graphData = [
            'profit_date' => [],
            'discount_date' => [],
            'debt_date' => []
        ];
        if(count($reports) < 1) return null;

        foreach ($reports as $key => $report) {
            $revenue += $report->total;
            $profit += $report->profit_margin;
            $debt += $report->debt_balance;
            $discount += $report->discount;
            array_push($graphData['profit_date'], [
                "amount"=> $report->profit_margin,
                "date"=> $report->created_at
            ]);
            array_push($graphData['discount_date'], [
                "amount"=> $report->discount,
                "date"=> $report->created_at
            ]);
            array_push($graphData['debt_date'], [
                "amount"=> $report->debt_balance,
                "date"=> $report->created_at
            ]);
        }

        $saleData = [
            'revenue' => $revenue,
            'profit' => $profit,
            'debt'=> $debt,
            'discount' => $discount,
            'graphData' => $graphData 
        ];

        return (isset($saleData[$val])) ? $saleData[$val] : '';
    }

    public function getSellableProducts (){
        $products = Product::where(['out_of_stock' => false])
        ->where('in_stock', '>', 1)
        ->where('selling_price', '>', 1)
        ->orderBy('id', 'ASC')
        ->get();

        $products_array = [];

        foreach ($products as $product) {
            $products_array['row'.$product->id] = $product;
            // array_push($products_array, ['row'.$product->id => $product]);
        }
        return $products_array;
    }

    public function store(Request $request){
        $settings = Settings::where('id', '<', 10)->first();

        $request->validate([
            'all_products' => ['required'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:255'],
            'method_of_payment' => ['required', 'string', 'max:255'],
            'on_hold' => ['required'],
            'total' => ['required']
        ]);
        // print_r($request->all());
        $data = $request->all_products;
        $productsData = json_decode($data);
        $profitMargin = 0;
        foreach ($productsData as $key => $pr) {
            $profitMargin += ($pr->selling_price - $pr->unit_cost) * $pr->quantity;
        }
        $profitMargin -= $request->discount;
        // print_r();
        // die();
        
        $sqlStatement = '';

        foreach ($productsData as $key => $value) {
            $sqlStatement .= 'UPDATE products SET in_stock = in_stock - '.$value->quantity.' WHERE id = '.$key.';';
        }
    
        $debtID = uniqid();
        $salesID = date('dmy').mt_rand(999,99999);
       
        if(isset($request->sales_id) && $request->on_hold === '0'){
            // for updating held sales    
            $salesStatus = Sale::where('sales_id', $request->sales_id)
              ->update([
                'cashier_name' => Auth::user()->name,
                'customer_name' => $request->customer_name,
                'discount' => $request->discount ?? 0,
                'total' => $request->total,
                'method_of_payment' => $request->method_of_payment,
                'customer_phone' => $request->customer_phone,
                'is_having_debts' => ($request->debt >= 1),
                'debt_id' => ($request->debt >= 1) ? $debtID : NULL,
                'debt_balance' => $request->debt ?? 0,
                'profit_margin' => $profitMargin,
                'on_hold' => $request->on_hold,
                'reg_by' => Auth::user()->id
            ]);
            ProductSales::where('sale_id', $request->sales_id)
              ->update([
                  'on_hold' => false
              ]);

        }else {
            $salesStatus = Sale::create([
                'cashier_name' => Auth::user()->name,
                'sales_id' => $salesID,
                'customer_name' => $request->customer_name,
                'discount' => $request->discount ?? 0,
                'total' => $request->total,
                'profit_margin' => $profitMargin,
                'method_of_payment' => $request->method_of_payment,
                'customer_phone' => $request->customer_phone,
                'is_having_debts' => ($request->debt >= 1),
                'debt_id' => ($request->debt >= 1) ? $debtID : NULL,
                'debt_balance' => $request->debt ?? 0,
                'on_hold' => $request->on_hold,
                'reg_by' => Auth::user()->id
            ]);

            if($salesStatus->wasRecentlyCreated === true) $addProductsStatus = $this->addProductSales($salesID, $productsData, $request->on_hold);
            // if items are not hold, update products quantity
            if($salesStatus->wasRecentlyCreated === true && $addProductsStatus === true && $request->on_hold === '0') {
                $updateProductStatus = DB::unprepared($sqlStatement);
            }
            // if anything fails
            if(!isset($addProductsStatus) || $addProductsStatus === false || (isset($updateProductStatus) && $updateProductStatus === false)) return view('admin.make-sales', ['error'=>'Cannot process sales. Try again', 'settings'=>$settings, 'products'=>$this->getSellableProducts()]);
        }
       

        if($request->on_hold){
            // sales not yet complete
            $salesOnHold = 'Sales has been put on hold. You can go to held receipts to continue';
            $products = $this->getSellableProducts();
            return view('admin.make-sales', ['salesOnHold'=>$salesOnHold, 'settings'=>$settings, 'products'=>$products]);
        }

        if($request->debt >= 1 && $request->on_hold === '0'){
            
            Debt::addDebt([
                'debt_id' => $debtID,
                'description' => 'Customer debt on sales',
                'initial_amount' => $request->debt,
                'total_debt_before' => $request->debt ,
                'total_debt_after' => $request->debt ,
                'amount_paid' => 0,
                'debt_type' => 'sales',
                'reg_by' => Auth::user()->id
            ]);
        }

        return redirect('admin/print-receipt/'.$salesID);
        // return back()->with('success', 'Sale made succesfully.');
    }

    public function addProductSales($salesID, $products, $on_hold){
        // ProductSales::
        if (gettype($products) !== 'object') return false;
        $allProducts = [];
        foreach ($products as $key => $value) {
            // $sqlStatement .= 'UPDATE products SET in_stock = in_stock - '.$value->quantity.' WHERE id = '.$key.';';
            array_push($allProducts, [
                'cashier_name' => Auth::user()->name,
                'product_name' => $value->productName,
                'product_id' => $key,
                'selling_price' => $value->selling_price,
                'quantity' => $value->quantity,
                'cost_price' => $value->unit_cost,
                'on_hold' => $on_hold,
                'profit_margin' => ($value->selling_price - $value->unit_cost) * $value->quantity,
                'total_cost' => $value->total,
                'reg_by' => Auth::user()->id,
                'sale_id' => $salesID
            ]);
        }
        // print_r($allProducts);
        // die();
        $createProductSalesStatus = ProductSales::insert($allProducts);
        return ($createProductSalesStatus);
    }

    public static function getProd($products, $selectedID, $getTotal = false){
        $getIds = explode('#', $selectedID);
        $getIds1 = explode(',', $getIds[0]);
        $selected = [];
        $total = 0;
        if($getIds1[0] === '') return $selected; 

        for ($i=0; $i < count($getIds1); $i++) { 
           if(isset($products['row'.$getIds1[$i]])){
               $selected['row'.$getIds1[$i]] = $products['row'.$getIds1[$i]];
               $total += $products['row'.$getIds1[$i]]->selling_price;
            }
        }

        return ($getTotal) ? $total : $selected;
    }

    public static function explodeProducts($data){
        return $data;
        /*$data = json_decode($data);
        if(gettype($data) !== 'object') return '';
        $products = '<small>';
        foreach ($data as $key => $prod){
            $products .= $prod->productName.' ('.$prod->quantity.' x '.$prod->selling_price.' = '.$prod->total.')<br>';
        }
        return $products.'</small>';*/
    }

    public function processHeldReciept($heldSaleId = null){
        if (is_null($heldSaleId)) return redirect('admin/sales/');

        $data['products'] = $this->getSellableProducts();
        $data['settings'] = Settings::where('id', '<', 10)->first();
        $data['heldSale'] = Sale::where('id', $heldSaleId)->first();
        if(!isset($data['heldSale']->id)) return redirect('admin/sales/');
        $data['heldProducts'] = ProductSales::where('sale_id', $data['heldSale']->sales_id)->get();
       
        if(!isset($_GET['items'])){
            $saleProducts = $data['heldProducts'];
            $productId= [];
            foreach ($saleProducts as $key => $prod){
                array_push($productId, $prod->product_id);
            }
           
            // return view('admin.held-sales', $data);
            // return redirect('admin/sales/'.$heldSaleId.'/?items='.implode(',',$productId));
            return redirect('admin/sales/?items='.implode(',',$productId));
        }
        
        return view('admin.sales', $data);
        // return redirect('admin/sales/'.$heldSaleId.'/?items='.implode(',',$productId));
    }
}
