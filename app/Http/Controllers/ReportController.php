<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\DebtController as Debt;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;
use App\Models\ProductSales;


class ReportController extends Controller
{
    public function index($report_type = null){ 
        $data['settings'] = Settings::where('id', '<', 10)->first();
            
        if(is_null($report_type)) return view('admin.404', $data);
        
        switch ($report_type) {
          case 'sales':
            $data['title'] = 'SALES REPORT';
            $data['subTitle'] = 'All sales reports';
            $data['showForm'] = true;
            $data['reports'] = $this->salesReport();
            return view('admin.reports', $data);
            break;

          case 'products':
            $data['title'] = 'PRODUCT REPORT';
            $data['subTitle'] = 'All product reports';
            $data['showForm'] = false;
            $data['reports'] = $this->productReport();
            return view('admin.reports', $data);
            break;

          default:
            # code...
            break;
        }
        return view('admin.reports', $data);
    }

    public function showDashboard(){
        // $data['products'] = $this->getSellableProducts();
        if(Auth::user()->role != 'admin') return redirect('admin/sales/');
        $data['settings'] = Settings::where('id', '<', 10)->first();
        $data['todaySales'] = ProductSales::where(['on_hold'=>false,'returned'=>false])->limit(5)->orderBy('id', 'DESC')->get();

        $data['lowProducts'] = Product::where('out_of_stock', '=', false)
          ->where('in_stock', '<=', $data['settings']->low_product_alert)
          ->get();
        
        $data['finsihedProducts'] = Product::where('out_of_stock', '=', true)
          ->where(['in_stock' => '0'])
          ->get();
        
        $data['confirmedOrders'] = Order::where(['confirmed_order' => true])->get();
        $data['queuedOrders'] = Order::where(['confirmed_order' => false])->get();
        $data['products'] = Product::all();
        
        return view('admin.dashboard', $data);
    }

    public function printReceipt($receipt_no = null){
      // print receipt
      $data['settings'] = Settings::where('id', '<', 10)->first();
      if(is_null($receipt_no)) return redirect('admin/sales/');
      $data['receiptDetails'] = Sale::where('sales_id', $receipt_no)->first();
      if(isset($data['receiptDetails']->id)) $data['receiptDetails']->products = ProductSales::where('sale_id', $receipt_no)->get();
      else return redirect('admin/sales/');
      return view('admin.print-receipt', $data);
    }


    public function sales($data = []){
        // show sales bases on dates
       return Sale::whereDate($data['column'], $data['condition'], $data['date'])
         ->where('on_hold', false)
         ->limit($data['limit'] ?? 5)
         ->get()
         ->sortDesc();
    }

    public function salesReport(){
      // sales report
      $startDate = $_GET['start-date'] ?? now();
      $stopDate = $_GET['start-date'] ?? now();
      $sales = Sale::where('on_hold', false)->get()->sortDesc();
     
      $data = [
          'headings' => array_keys($sales->toArray()[0]),
          'body' => $sales->toArray()
      ];
       
      $tbody = '<thead><tr><th>'.implode('</th><th>',$data['headings']).'</th></tr></thead>';
      $tbody .= '<tbody>';

      for ($i=0; $i < count($data['body'])-1; $i++) { 
        $tbody .= '<tr><td>'.implode('</td><td>',$data['body'][$i]).'</td></tr>';
      }
      $tbody .= '</tbody>';        
      return $tbody;
    }


    public function productReport(){
      // product report
      $startDate = $_GET['start-date'] ?? now();
      $stopDate = $_GET['start-date'] ?? now();
      $sales = Product::all()->sortDesc();
     
      $data = [
          'headings' => array_keys($sales->toArray()[0]),
          'body' => $sales->toArray()
      ];
       
      $tbody = '<thead class="text-uppercase"><tr><th>'.implode('</th><th>',$data['headings']).'</th></tr></thead>';
      $tbody .= '<tbody>';

      for ($i=0; $i < count($data['body'])-1; $i++) { 
        $tbody .= '<tr><td>'.implode('</td><td>',$data['body'][$i]).'</td></tr>';
      }
      $tbody .= '</tbody>';        
      return $tbody;
    }

    public function expiringProducts(){
      $data['settings'] = Settings::where('id', '<', 10)->first();
      return view('admin.expiring', $data);
    }
}
