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
        
              <h3 class="box-title text-right">Manage staff</h3>
            </div>
            <!-- /.box-header -->
            <div class="row">
            <div class="col-md-5">
            <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form role="form" method="POST" action="{{ route('new.staff') }}">
            @csrf  
            <div class="row">
              <div class="box-body">

              <div class="col-md-6">

                <div class="form-group">
                  <label for="name">Name<b style="color: red">*</b></label>
                  <x-input type="text" :value="old('name')" class="form-control" name="name" id="name" required />
                </div>
                <div class="form-group">
                  <label for="username">Username<b style="color: red">*</b></label>
                  <x-input type="text" :value="old('username')" class="form-control" name="username" id="email" required />
                </div>

                <div class="form-group">
                  <label for="role">Role<b style="color: red">*</b></label>
                  <select name="role" id="role" class="form-control">
                    <option value="user">Cashier</option>
                    <option value="admin">Admin</option>
                  </select>
                </div>
              </div>



              <div class="col-md-6">
                <div class="form-group">
                  <div class="form-group">
                  <label for="password" >Password </label>
                  <x-input type="password" :value="old('password')" minlength="4" maxlength="10" class="form-control" name="password" id="password" required />
                </div>

                </div>

                <div class="form-group">
                  <label for="password2">Repeat password</label><b style="color: red">*</b>
                  <x-input type="password" :value="old('password2')" minlength="4" maxlength="10" class="form-control" name="password2" id="password_confirmation" required />
                </div>
              </div>
              </div>
            </div>


             <div class="row">
              <div class="box-body">

              <div class="col-md-6">
                 <div class="form-group">
                   <button class="btn btn-success">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
                  <!-- <input type="submit" class="btn btn-primary" value="Add"> -->
                  <a href="{{url('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
                 </div>
              </div>

              <div class="col-md-6"></div>

              </div>
            </div>
            </form>
            </div>
            <div class="col-md-7">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Password</th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>             
                <tbody>
                @forelse ($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->role }}</td>
                  <td>{{ $user->password }}</td>
                  <td>
                    <a type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success-edit"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    <a href="#" class='btn btn-danger' name="delete" data-toggle="modal" data-target="#modal-success" ><i class='fa fa-trash'></i> Delete</a>
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
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>
        <!-- /.col -->
         <div class="col-md-1"></div>
      </div>
      <!-- /.row -->
      
      <!-- Modal for View confirm Order  -->
        <div class="modal fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: darkcyan;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="text-center" style="font-weight: bolder;">DARL DISTRIBUTORS<br>NIG. LTD<br>Wholesales and Retail</h4>
            
              </div>
              <div class="modal-body">
               <form role="form" class="form">
                <div class="row fixed">
                  <div class="col-md-6">
                     
                        <label>Sale by: </label> Joseph<br>
                        <label>receipt No.: </label> 01995<br>
                        <label>Date.: </label> 07/27/1995
                  
                  </div>

                   <div class="col-md-6">
                 
                        <label>Customer: </label> Jetstream Limited <br>
                        <label>Delivery Type: </label> Personal <br>
                        <label>Mobile.: </label> 08188701995
         
                  </div>
                  
                </div>
                
               </form>
               <table class="table">
                      

                <tr>
                  <th>DESCRIPTION</th>
                  <th>QTY</th>
                  <th>PRICE</th>
                  <th>DISCOUNT</th>
                  <th>AMOUNT</th>
                </tr>

                 <tr>
                  <th>Semovita 2kg</th>
                  <th>2</th>
                  <th>350</th>
                  <th>-</th>
                  <th>700</th>
                </tr>
         
              </table>

              </div>
              <div class="modal-footer">
                <button style="background-color: red;" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>

                <button style="background-color: darkred;"  type="button" class="btn btn-outline pull-center" data-toggle="modal" data-target="#modal-success-edit">Edit</button>

                <button style="background-color: darkcyan;"  type="button" class="btn btn-outline pull-center">Print</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


            <!-- Modal for View confirm Order  -->
        <div class="modal fade" id="modal-success-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: darkcyan;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="text-center" style="font-weight: bolder;">DARL DISTRIBUTORS<br>NIG. LTD<br>Wholesales and Retail</h4>
            
              </div>
              <div class="modal-body">
         <form role="form" method="POST" action="newCustomerForm.php">
              <div class="box-footer">
                <b style="color: red">Form B - Editing Sales</b>
              </div>
           
              <div class="row">
              <div class="box-body">

              <div class="col-md-6">

                <div class="form-group">
                  <label>Customer Name <b style="color: red">*</b></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option disabled selected>--Select--</option>
                    <option value="Abia">Abia</option>
                    <option value="Zamfara">Zamfara</option>
                    </select>
                </div>

                <div class="form-group">
                  <label>Product Name <b style="color: red">*</b></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option disabled selected>--Select--</option>
                    <option value="Abia">Abia</option>
                    <option value="Zamfara">Zamfara</option>
                    </select>
                </div>

                <div class="form-group">
                  <label>Product Brand <b style="color: red">*</b></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option disabled selected>--Select--</option>
                    <option value="Abia">Abia</option>
                    <option value="Zamfara">Zamfara</option>
                    </select>
                </div>

                <div class="form-group">
                  <label>Product Category <b style="color: red">*</b></label>
                  <select class="form-control select2">
                    <option disabled selected>--Select--</option>
                    <option value="Abia">Abia</option>
                    <option value="Zamfara">Zamfara</option>
                    </select>
                </div>
               
                 <div class="form-group">
                  <label>Product Description <b style="color: red">*</b></label>
                  <textarea class="form-control" name="sAddress"></textarea>
                </div>

                <div class="form-group">
                  <label>Delivery Type<b style="color: red">*</b></label>
                  <select class="form-control select2">
                    <option disabled selected>--Select--</option>
                    <option value="Abia">Constructive Delivery</option>
                    <option value="Zamfara">Actual Delivery</option>
                    <option value="Zamfara">Symbolic Delivery</option>
                    </select>
                </div>
              </div>



              <div class="col-md-6">
                <div class="form-group">
                  <label>Date Order<b style="color: red">*</b></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input name="datepurchased" type="date" class="form-control">
                </div>
                </div>

                <div class="form-group">
                  <label>Date Needed<b style="color: red">*</b></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input name="datepurchased" type="date" class="form-control">
                </div>
                </div>

                <div class="form-group">
                  <label>Quantity <b style="color: red">*</b></label>
                  <input class="form-control" name="purchaseDetailsQuantity" id="purchaseDetailsQuantity" placeholder="0"></input>
                </div>
                
                 <div class="form-group">
                  <label>Unit Price <b style="color: red">*</b></label>
                  <input class="form-control" id="purchaseDetailsUnitPrice" name="purchaseDetailsUnitPrice" placeholder="0"></input>
                </div>

                <div class="form-group">
                <label>Total Cost<b style="color: red">*</b></label>
                  <input type="text" class="form-control" id="purchaseDetailsTotal" name="purchaseDetailsTotal" readonly>
                </div>

                <div class="form-group">
                <label>Vendor/Cashier Name <b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="brandName">
                </div>
                

              </div>
              </div>
            </div>


              <div class="modal-footer">
                <button style="background-color: darkred;" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>


                <button style="background-color: darkcyan;"  type="button" class="btn btn-outline pull-center">Update</button>
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

<!-- Autocalculation -->
<!-- Custom scripts -->
  <script src="/vendor/auto/scripts.js"></script>




  <!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>