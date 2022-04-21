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
            <div class="box-header">
        
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="text-right">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-success-NewProduct">Add New Expenses</a>
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
                  <th>Expenditure Date</th>
                   <th>Type of Expenses</th>
                   <th>Description</th>
                   <th>Incured by</th>
                   <th>Amount</th>
                   <th>Action</th>
                </tr>
                </thead>  

                <tbody>
                @forelse ($expenses as $expense)
                <tr>
                  <td>{{ $expense->date }}</td>
                  <td>{{ $expense->expense_type }}</td>
                  <td>{{ $expense->comment }}</td>
                  <td>{{ $expense->incured_by }}</td>
                  <td>{!!$settings->currency!!}{{ number_format($expense->amount) }}</td>
                  <td>   
                  <a href="#" class='btn btn-sm btn-primary' name="delete" data-toggle="modal" data-target="#modal-success-product-edit"><i class='fa fa-edit'></i></a>         
                    <a href="#" class='btn btn-sm btn-danger' name="delete" ><i class='fa fa-trash'></i></a>
                 </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6">No expenses yet. Click on <a href="#">new expenses</a> to create a new expense </td>
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
              <div class="modal-header" style="background-color: darkcyan;">
                <button style="color: red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="text-center" style="font-weight: bolder;">DARL DISTRIBUTORS NIG. LTD<br>Editing Expenses</h4>
              </div>
              <div class="modal-body"> 
              
            <form role="form" method="POST" action="">
              @csrf  
              <div class="row">
              <div class="box-body">
                <div class="form-group">
                  <label>Date<b style="color: red">*</b></label>
                  <input type="date" max="{{date('Y-m-d')}}" class="form-control" name="date2" required>
                </div>
                <div class="form-group">
                  <label >Type of Expenses <b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="type_of_expense2" required>
                </div>
                  <div class="form-group">
                  <label for="description" >Description</label>
                  <textarea class="form-control" name="description2" id="description" required></textarea>
                </div>
                <div class="form-group">
                  <label> Incured by <b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="incured_by2" placeholder="Enter name">
                </div>

                  <div class="form-group">
                  <label>Amount<b style="color: red">*</b></label>
                  <input type="mobile" minlength="11" class="form-control" name="amount2">
                </div>
              </div>
              </div>


 
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <button  type="submit" class="btn btn-primary">Add expense</button>
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
                <h4 class="modal-title"><b>New Expenses</b></h4>
              </div>
              <div class="modal-body">

          <!-- after form submission, there should be link to Sale Order Form: Form B -->
          <form role="form" method="POST" action="{{ route('expenses.add') }}">
              @csrf  
              <div class="row">
              <div class="box-body">
                
                <div class="form-group">
                  <label>Date<b style="color: red">*</b></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input name="date" type="date" max="{{date('Y-m-d')}}" class="form-control" required>
                </div>
                </div>

                 <div class="form-group">
                    <label>Type of Expenses <b style="color: red">*</b></label>
                    <select class="form-control select2" style="width: 100%" name="type" required>
                      <option disabled selected>--Select--</option>
                      <option value="Tax">Tax</option>
                       <option value="Travel">Travel</option>
                      <option value="Rent">Rent</option>
                       <option value="Advertising">Advertising</option>
                      <option value="Insurance">Insurance</option>
                      <option value="Salaries">Salaries</option>
                       <option value="Ultility">Ultility bill</option>
                      <option value="Delivery/Freight">Delivery/Freight</option>
                      <option value="Debts(Loans and Mortgages)">Debts(Loans and Mortgages)</option>
                       <option value="Office Equipment">Office Equipment</option>
                      <option value="Maintenance and Repairs">Maintenance and Repairs</option>
                      <option value="Other Expenses">Other Expenses</option>
                    </select>
                </div>
                  <div class="form-group">
                  <label >Description</label>
                  <textarea class="form-control" name="description" id="description"></textarea>
                </div>
                <div class="form-group">
                  <label> Incured by <b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="incured_by">
                </div>
               
                 <div class="form-group">
                  <label>Amount<b style="color: red">*</b></label>
                  <input type="number" min="1" class="form-control" name="amount">
                </div>
              </div>
              </div>
 
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <button  type="submit" class="btn btn-primary">Add expense</button>
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
    <strong>Copyright &copy; 2020  - <?php echo date("Y"); ?> <a target="_blank" href="#">Darl Distributors</a>.</strong> All rights
    reserved.
</footer>

  
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

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