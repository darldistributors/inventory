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
        
              <!-- <h3 class="box-title text-right"><b style="color:red;"> IMPORTANT</b></h3> -->
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="text-right">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-success-NewProduct">Add New Product</a>
              </div>
              <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
              <hr>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Unit cost</th>
                   <th>Company Name</th>
                   <th>Company Address</th>
                   <th>Supplier Name</th>
                   <th>Supplier Phone</th>
                    <th>Action</th>
                </tr>
                </thead>  

                <tbody>
                @forelse ($products as $product)
                <tr>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->unit_cost }}</td>
                  <td>{{ $product->comapnay_name }}</td>
                  <td>{{ $product->company_address }}</td>
                  <td>{{ $product->supplier_name }}</td>
                  <td>{{ $product->supplier_phone }}</td>
                  <td>
                    <a href="#" class='btn btn-sm btn-primary' name="delete" data-toggle="modal" data-target="#modal-success-product-edit"><i class='fa fa-edit'></i></a>         
                    <a href="#" class='btn btn-sm btn-danger' name="delete" ><i class='fa fa-trash'></i></a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">No staff yet. Click on <a href="#">new staff</a> to create staff </td>
                </tr>
                @endforelse
                </tbody>
         
              </table>
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

                <h4 class="text-center" style="font-weight: bolder;">DARL DISTRIBUTORS NIG. LTD<br>Editing Product</h4>
              </div>
              <div class="modal-body">
                  
              <form role="form" method="POST" action="">
                @csrf  
            
              <div class="row">
              <div class="box-body">
                <div class="form-group">
                  <label for="pName" >Product Name<b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="pName">
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

                <button  type="button" class="btn btn-primary">Update</button>
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


              <form role="form" method="POST" action="{{ route('new.product') }}">
                @csrf  
              <div class="row">
              <div class="box-body">
                <div class="form-group">
                  <label for="productName" >Product Name<b style="color: red">*</b></label>
                  <x-input :value="old('productName')" type="text" class="form-control" name="productName" id="productName"/>
                </div>
                <div class="form-group">
                  <label for="unitCost" >Unit cost<b style="color: red">*</b></label>
                  <x-input :value="old('unitCost')" type="number" min="0" value="5" class="form-control" name="unitCost" id="productName"/>
                </div>
                <div class="form-group">
                  <label for="companyName" >Company Name <b style="color: red">*</b></label>
                  <x-input :value="old('companyName')" type="text" class="form-control" name="companyName" id="companyName"/>
                </div>
                  <div class="form-group">
                  <label for="companyAddress">Company Address</label>
                  <x-input :value="old('companyAddress')" name="companyAddress" type="text" class="form-control" id="companyAddress"/>
                </div>
                <div class="form-group">
                  <label for="supplierName"> Supplier Name <b style="color: red">*</b></label>
                  <x-input :value="old('supplierName')" type="text" class="form-control" name="supplierName" id="supplierName"/>
                </div>
               
                 <div class="form-group">
                  <label for="supplierPhone">Supplier Phone<b style="color: red">*</b></label>
                  <x-input :value="old('supplierPhone')" type="tel" minlength="11" maxlength="11" class="form-control" name="supplierPhone" id="supplierPhone"/>
                </div>
              </div>
              </div>

 
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <button  type="submit" class="btn btn-primary">Register</button>
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




  <!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>