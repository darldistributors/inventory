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

  
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="box">
            <div class="box-header">
        
              <h3 class="text-center"><b> {{$title}}</b></h3>
              <h4 class="text-center"><i>(FROM {{$_GET['start-date'] ?? date('Y-m-d')}} TO {{$_GET['stop-date'] ?? date('Y-m-d')}})</i></h4>
            
              <!-- more records starts here -->
              @inject('reports', 'App\Http\Controllers\SaleController')
              @if($show_filter) 
              <div class="row">
                 <div class="col-md-12"><button onclick="showHide()" class="btn-block">More details <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></button></div>
                </div>
                <div class="row" id="show-hide" style="display:none">
                 <div class="col-md-6">
                    <ul class="list-group mt-2">
                      <li class="list-group-item active text-center">MORE DETAILS </li>
                      <li class="list-group-item">Total Sales: <span class="badge badge-lg badge-primary">{{count($sales) ?? 0}}</span></li>
                      <li class="list-group-item">Total Revenue: <span class="badge badge-lg badge-primary">{!!$settings->currency!!}{{number_format($reports::salesSummary($sales, 'revenue')) ?? 0}}</span></li>
                      <li class="list-group-item">Profit margin: <span class="badge badge-lg badge-primary">{!!$settings->currency!!}{{number_format($reports::salesSummary($sales, 'profit')) ?? 0}}</span></li>
                      <li class="list-group-item">Debt incured: <span class="badge badge-lg badge-primary">{!!$settings->currency!!}{{number_format($reports::salesSummary($sales, 'debt')) ?? 0}}</span></li>
                      <li class="list-group-item">Discount allowed: <span class="badge badge-lg badge-primary">{!!$settings->currency!!}{{number_format($reports::salesSummary($sales, 'discount')) ?? 0}}</span></li>
                    </ul>
                 </div>
                 <div class="col-md-6">
                   <canvas id="myChart" style="width: 70%; height: 100px"></canvas>
                 </div>
                </div>
                @endif
            <!-- more records stops here -->

              <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />
            @if (session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
              </button>
              {{ session('success') }}
            </div>
            @endif
            </div>
            <!-- /.box-header -->
            @if($show_filter)
            <form action="" method="get" style="padding-left: 20px">
              <div class="row">
                <div class="col-md-3">
                  <label for="start-date">From:</label>
                  <input type="date" name="start-date" id="start-date" class="form-control" required max="{{date('Y-m-d')}}" value="{{$_GET['start-date'] ?? date('Y-m-d')}}"  >
                </div>

                <div class="col-md-3">
                  <label for="stop-date">To:</label>
                  <input type="date" name="stop-date" id="stop-date" class="form-control" required max="{{date('Y-m-d')}}" value="{{$_GET['stop-date'] ?? date('Y-m-d')}}" >
                </div>  

                <div class="col-md-3">
                  <label for="cahsier">By Cashier</label>

                  <select name="cashier_id" id="cashier" class="form-control">
                    <option value="all">all</option>
                    @forelse ($cashiers as $cashier)
                    <option value="{{$cashier->id}}">{{$cashier->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3">
                <br>    
                <button class="btn btn-sm   btn-success">Filter display  <i class="fa fa-search" aria-hidden="true"></i></button>
              </div>  
              </div>
            </form>
            @endif
            <br>


            <div class="box-body table-responsive">
              <table id="example1" class="table table-hover table-bordered table-sm table-striped">
                <thead>
                <tr>
                  <th>id</th> 
                  <th>Date</th>
                  <th>Customer name</th>
                  <th>Receipt number</th>
                  <th>Discount</th>
                  <th>Total</th>
                  <th>Profit margin</th>
                  <th>Method of payment</th>
                  <th>Customer phone</th>
                  <th>Debt balance</th>
                  <!--th>Sold by</th-->
                  <th></th>
                </tr>
                </thead>  
                
                @inject('salesProducts', 'App\Http\Controllers\SaleController')

                <tbody>
                @forelse ($sales as $sale)
                <tr>
                  <td>{{$loop->iteration}}</td>  
                  <td>{{$sale->created_at}}</td>
                  <td>{{$sale->customer_name}}</td>
                  <td><a href="../print-receipt/{{$sale->sales_id}}">{{$sale->sales_id}}</a></td>
                  <td>{!!$settings->currency!!}{{number_format($sale->discount)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($sale->total)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($sale->profit_margin)}}</td>
                  <td>{{$sale->method_of_payment}}</td>
                  <td>{{$sale->customer_phone}}</td>
                  <td>{!!$settings->currency!!}{{number_format($sale->debt_balance)}}</td>
                  <td>
                    @if (isset($is_held))
                      <a class="btn btn-sm btn-success" href="/admin/held-sales/{{$sale->id}}">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    @else
                    <a href="../print-receipt/{{$sale->sales_id}}" class='btn btn-sm btn-success'>Reprint <i class='fa fa-check'></i></a>         
                    <a href="#" data-toggle="modal" data-target="#modal-success-product-edit" class='btn btn-sm btn-danger'  ><i class='fa fa-trash'></i>Return receipt</a>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="11">No sales made yet. Click on <a href="#">new sales</a> to make sales </td>
                </tr>
                @endforelse
                </tbody>
         
              </table>
            </div>
            <div class="row">
            <div class="col-md-12">
                <!--div class="alert alert-info">
                  <strong>Note: </strong> To download more than 1000 records, you have to use this button: <button style="float:right" class="btn btn-sm btn-success">Download <i class="fa fa-download" aria-hidden="true"></i> </button>
                </div-->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col -->
         <div class="col-md-1"></div>
      </div>
      <!-- /.row -->


      <!-- Modal for View Inventory Report -->
        <div class="modal fade" id="modal-success-product-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: darkcyan;">
                <button style="color: red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="text-center" style="font-weight: bolder;">{{$settings->business_name}}</h4>
                <h5 class="text-center">RETURN RECEIPT</h5>
              </div>
              <div class="modal-body">
                <h4 class="text-center" id='product_name1'></h4>
            <form role="form" method="POST" action="{{ route('received.order') }}">
              @csrf
              <div class="display-1 text-center">
                Are you sure you want to return this receipt?
                <br>
                <small> <span style="color:red">Note:   </span> Returning a receipt implies all items will be returned to inventory</small>
              </div>
              <br>
                <label for="yes">
                  <input id="yes" type="checkbox" required>
                  Yes I understand
                </label>
 
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <button  type="submit" class="btn btn-success">Continue</button>
              </div>

            </form>

              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

      <!-- Modal for View Inventory Report -->
          <div class="modal fade" id="modal-success-NewProduct">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color:darkcyan">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Product Registration</b></h4>
              </div>
              <div class="modal-body">

          <!-- after form submission, there should be link to Sale Order Form: Form B -->
            <form  method="POST" action="#">
           
              <div class="row">
              <div class="box-body">
                <div class="form-group">
                  <label>Product Name<b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="sId">
                </div>
                <div class="form-group">
                  <label >Company Name <b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="sname">
                </div>
                  <div class="form-group">
                  <label >Company Address</label>
                  <input type="text" class="form-control" name="sname">
                </div>
                <div class="form-group">
                  <label> Supplier Name <b style="color: red">*</b></label>
                  <input type="phone" class="form-control" name="pCategory">
                </div>
               
                 <div class="form-group">
                  <label>Supplier Phone<b style="color: red">*</b></label>
                  <input type="mobile" minlength="11" class="form-control" name="pCategory">
                </div>
              </div>
              </div>

 
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <button  type="button" class="btn btn-primary">Register</button>
              </div>

            </form>
              </div>
            
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section>
    <!-- /.content -->
  </div>
 

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020  - <?php echo date("Y"); ?> </strong> All rights
    reserved.
</footer>

  
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<script src="/bower_components/chart.js/Chart.js"></script>

<script>
  var clickNumb = 1;
  function showHide(){
    clickNumb ++;
    if(clickNumb%2 ===0) document.getElementById('show-hide').style.display = 'block';
    else document.getElementById('show-hide').style.display = 'none';
    // alert(clickNumb%2)
  }
var ctx = document.getElementById('myChart').getContext('2d');

var profit = {{$reports::salesSummary($sales, 'profit') ?? 0}};
var debt = {{$reports::salesSummary($sales, 'debt') ?? 0}};
var discount = {{$reports::salesSummary($sales, 'discount') ?? 0}};

var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Profit', 'Debt', 'Discount'],
        datasets: [{
            label: '# of Votes',
            data: [profit, debt, discount],
            backgroundColor: [
                'rgba(0, 255, 0, 0.2)',
                'rgba(255, 0, 0, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                '{{$settings->primary_color ?? '#000000'}}',
                '{{$settings->primary_color ?? '#000000'}}',
                '{{$settings->primary_color ?? '#000000'}}',
            ],
            borderWidth: 1
        }]
    }
});
</script>
<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
 
  $.widget.bridge('uibutton', $.ui.button);

    $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>




  <!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>