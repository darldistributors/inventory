<!DOCTYPE html>
<html>
<head>
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
        
              <h3 class="box-title text-right"><b>Purchases Report</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="form-group">
                    <button class="btn btn-sm btn-info" type="button">PDF</button>
                    <button class="btn btn-sm btn-info" type="button">Excel</button>
                    <button class="btn btn-sm btn-info" type="button">MS WORD</button>
                    <button class="btn btn-sm btn-info" type="button">NOTEPAD</button>
                     <b style="border-left: 6px solid green; height: 500px; font-size: 17px;"> Extract Record </b>
                 </div>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                   <th>Phone</th>
                   <th>Action</th>
                </tr>
                </thead>             
                <tr>
                  <td>Misc</td>
                  <td>PSP browser</td>
                  <td>PSP browser</td>
                  <td>PSP browser</td>
            
                    

                    <td>
                      

                    <a href="#" class='btn btn-danger' name="delete" ><i class='fa fa-trash'></i></a>

                 <a type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">view</a>

                 </td>
                </tr>
         
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
      
      <!-- Modal for View confirm Order  -->
             <div class="modal fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color:darkcyan; color: white;">
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
                <button style="background-color: darkcyan;" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>

                <button style="background-color: darkred;"  type="button" class="btn btn-outline pull-center" data-toggle="modal" data-target="#modal-success-edit">Edit</button>

                <button style="background-color: green;"  type="button" class="btn btn-outline pull-center">Print</button>
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
              <div class="modal-header" style="background-color:darkcyan; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="text-center" style="font-weight: bolder;">DARL DISTRIBUTORS<br>NIG. LTD<br>Wholesales and Retail</h4>
            
              </div>
              <div class="modal-body">
         <form role="form" method="POST" action="newCustomerForm.php">
              <div class="box-footer">
                <b style="color: red"> Editing Purchase Order Report</b>
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