@include('/head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
@include('/header')
</header>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
  @include('/adminLeftSideBar')
  </aside>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
     
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content"> 
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="color: green">Previous sales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product</th>
                   <th>Total</th>
                   <th>Cashier</th>
                </tr>
                </thead>  
              
                <tbody>
                @forelse ($todaySales as $sale)
                <tr>
                  <td>{{$sale->product_name}}</td>
                  <td>{{$sale->quantity}} X {!!$settings->currency!!}{{number_format($sale->selling_price)}} = {!!$settings->currency!!}{{number_format($sale->total_cost)}}</td>
                  <td>{{$sale->cashier_name}}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3">Nothing to show</td>
                </tr>
                @endforelse
                </tbody>
         
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="color: green">Products</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
              <!-- <div class="col-md-12">
                <canvas height="4vh" width="80vw" id="myChart"></canvas>
              </div> -->
              <div class="chart-container">
              <canvas id="myChart"></canvas>
            </div>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="color: red">Low Products</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              <thead>  
              <tr>  
                  <th>Product name</th>
                  <th>Product quantity</th>
                  <th>Last updated</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($lowProducts as $product)
                <tr>
                  <td>{{$product->name}}</td>
                  <td>{{$product->in_stock}}</td>
                  <td>{{$product->updated_at}}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3">Stocks are in order</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

         <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="color: red">Expiry alert</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>  
              <tr>  
                  <th>Product name</th>
                  <th>Product quantity</th>
                  <th>Last updated</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($finsihedProducts as $product)
                <tr>
                  <td>{{$product->name}}</td>
                  <td>{{$product->in_stock}}</td>
                  <td>{{$product->updated_at}}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3">No finished goods</td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>


       <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($confirmedOrders)}}</h3>

              <p>Total confirmed orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($finsihedProducts)}}</h3>

              <p>Products Out of Stock</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>-</h3>

              <p>Expired Products</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{count($lowProducts)}}</h3>

              <p>Low Products</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
      </div>

       <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($products)}}</h3>

              <p>Total products</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($queuedOrders)}}</h3>

              <p>Queued orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{count($finsihedProducts)}}</h3>

              <p>Products Out of Stock</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{count($todaySales)}}</h3>

              <p>Today Sales</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <x-nav-link href="{{route('reports')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></x-nav-link>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- /.row -->

    </section>
  </div>

  
  @include('/footer')
  <script>

    var ctx = document.getElementById('myChart').getContext('2d');

    var profit = 23;
    var debt = 23;
    var discount = 23;

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['In stock', 'Low products'],
            datasets: [{
                label: 'Product summary',
                data: [{{count($products)}}, {{count($lowProducts)}}],
                backgroundColor: [
                    'rgba(0, 255, 0, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    '{{$settings->primary_color ?? '#000000'}}',
                    '{{$settings->primary_color ?? '#000000'}}',
                ],
                borderWidth: 1
            }]
        }
    });
</script>