@include('/head')
</head>
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
            <!-- /.box-header -->
            <div class="box-body">
              <div class="text-right">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-success-NewProduct">Add New Debt</a>
              </div>
              <hr>
              <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />
              @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
              @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Debt id</th>
                   <th>Description</th>
                   <th>Initial amount</th>
                   <th>Total debt before</th>
                   <th>Total debt after</th>
                   <th>Amount paid</th>
                   <th>incured from</th>
                </tr>
                </thead>  

                <tbody>
                @forelse ($debts as $debt)
                <tr>
                  <td><a href="debt/detils/{{$debt->debt_id}}">{{$debt->debt_id}}</a></td>
                  <td>{{$debt->description}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->initial_amount)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->total_debt_before)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->total_debt_after)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->amount_paid)}}</td>
                  <td>{{$debt->debt_type}}</td>
                  <td>   
                  <a href="#" class='btn btn-sm btn-success' onclick="populateForm('{{$debt->debt_id}}', {{$debt->total_debt_after}})" name="delete" data-toggle="modal" data-target="#modal-success-product-edit">Pay debt</a>         
                    <a href="debt/detils/{{$debt->debt_id}}" class='btn btn-sm btn-primary' name="delete" >See debt history </a>
                 </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6">No debts yet. Click on <a href="#">new debt</a> to enter a new debt </td>
                </tr>
                @endforelse
                </tbody>
         
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div><!-- /.col -->

         <div class="col-md-1"></div>
      </div>
      <!-- /.row -->


      <!-- Modal for View Inventory Report -->
        <div class="modal fade" id="modal-success-product-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background: {{$settings->primary_color ?? '#000'}}">
                <button style="color: red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="text-center" style="font-weight: bolder;">{{$settings->business_name ?? '#000'}}<br>Editing Expenses</h4>
                <div class="text-center">Receive debt payment in installment or in full</div>
              </div>
              <div class="modal-body"> 
              
            <form role="form" method="POST" action="{{ route('debts.update') }}">
              @csrf  
              <div class="form-group">
                  <label for="debt_id">Debt ID</label>
                  <input type="text" readonly  id="debt_id2" name="debt_id" class="form-control" min="1" required />
                </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="Number" id="amount2" name="amount" class="form-control" min="1" required />
                </div>
                <label for="sure">
                  <input id="sure" type="checkbox" required> Are you sure you wish to proceed with receiving this payment?
                </label><br>
              <button class="btn btn-bg btn-success" type="submit">Recieve payment</button>
              <button  type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

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
              <div class="modal-header" style="background: {{$settings->primary_color ?? '#000'}}">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>New Debt</b></h4>
              </div>
              <div class="modal-body">

          <!-- after form submission, there should be link to Sale Order Form: Form B -->
          <form role="form" method="POST" action="{{ route('debts.new') }}">
              @csrf  
              
              <div class="form-group">
              <label for="initial_amount">Amount <span style="color:red">*</span></label>
              <input type="Number" id="initial_amount" min="1" step="0" name="initial_amount" class="form-control" required />
              </div>
              
              <div class="form-group">
              <label for="description">Description <span style="color:red">*</span></label>
              <textarea  id="description" name="description" class="form-control" required></textarea>
              </div>

              <div class="form-group">
              <label for="debt_type">Debt type <span style="color:red">*</span></label>
              <select id="debt_type" name="debt_type" class="form-control" required>
                <option value="">--Select debt type</option>
                <option value="Sales">On Sales</option>
                <option value="Staff">Staff</option>
                <option value="Others">Others</option>
              </select>  
              </div>
              
              <button class="btn btn-bg btn-success" type="submit">Add debt</button>
              <button  type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              
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
    <strong>Copyright &copy; 2020  - <?php echo date("Y"); ?> .</strong> All rights
    reserved.
</footer>

  
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
  function populateForm(debt_id, amount){
    var debt_id2 = document.getElementById('debt_id2');
    var amount2 = document.getElementById('amount2');
    
    debt_id2.value = debt_id
    amount2.setAttribute('max', amount)
    amount2.value = amount
  }
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
  $(function () {
   //Initialize Select2 Elements
    $('.select2').select2()

})
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

<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>

  <!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>