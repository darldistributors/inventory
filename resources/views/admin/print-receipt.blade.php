<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>::Print receipt::</title>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">


</head>
<body>
  <div class="container">
    <div class="row text-center">
      <!-- <div class="col-md-4"></div> -->
      <div class="col-md-12 bordered">
      <h1>{{$settings->business_name ?? 'INVENTORY'}}</h1>
        <h3><u>{{$receiptDetails->sales_id ?? '-'}}</u></h3>
        <small>{{$settings->business_address ?? ''}} | </small>
        <small>{{$settings->contact_email ?? ''}} | </small>
        <small>{{$settings->contact_phone ?? ''}}</small>
        <h3>Sales receipt</h3>
        <h6>Date: {{date('d/m/Y')}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cashier: {{$receiptDetails->cashier_name}}</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>S/N</th>
              <th>Item</th>
              <th>Quantity</th>
              <th>Unit cost</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
                @forelse ($receiptDetails->products as $product)
                <tr>
                  <td><small>{{ $loop->iteration }}</small></td>
                  <td><small>{{ $product->product_name }}</small></td>
                  <td><small>{{ $product->quantity }}</small></td>
                  <td><small>&#8358;{{ number_format($product->selling_price) }}</small></td>
                  <td><small>&#8358;{{ number_format($product->total_cost) }}</small></td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">No product added</td>
                </tr>
                @endforelse
                <tr>
                <td colspan="5"><small>Amount paid:</small><h2>{!!$settings->currency!!}{{number_format($receiptDetails->total)}}</h2></td>
                </tr>
                <tr>
                  <td>Discount on sales:<br><small style='font-weight:bolder; padding:5px'>&#8358;{{number_format($receiptDetails->discount)}}</small></td>
                  <td>Debt on sales:<br><small style='font-weight:bolder; padding:5px'>&#8358;{{number_format($receiptDetails->debt_balance)}}</small></td>
                  <td>Payment method:<br><small style='font-weight:bolder; padding:5px'>{{$receiptDetails->method_of_payment}}</small></td>
                  <td>Debt ID:<br><small style='font-weight:bolder; padding:5px'>{{$receiptDetails->debt_id ?? 'NILL'}}</small></td>
                </tr>
                <tr>
                  <td colspan="3">Customer name: {{$receiptDetails->customer_name ?? ''}}</td>
                  <td colspan="2">Customer phone: {{$receiptDetails->customer_phone  ?? ''}}</td>
                </tr>
                <tr>
                  <td colspan="5" style="color: #fff; background: #000">
                    {{$settings->receipt_message ?? 'Thank you for the patronage'}}
                    <hr>
                    <div id='msg' style="display: none">
                    <button type="button" class="btn btn-success" onclick="location.reload()">Reprint</button>
                    <x-nav-link :href="route('sales')" class="btn btn-primary">
                      &lt;&lt;New sales
                    </x-nav-link>
                  </div>    
                  </td>
                </tr>

          </tbody>
        </table>
      </div>
      <!-- <div class="col-md-4"></div> -->
    </div>
  </div>
  


<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    window.print();
    setTimeout(() => {
      document.getElementById('msg').style.display='block'   
    }, 1200);
  </script>
</body>
</html>