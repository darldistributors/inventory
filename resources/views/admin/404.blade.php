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
          <h1 class="text-center display-1">404 NOT FOUND</h1>  
        </div>
        <!-- /.col -->
         <div class="col-md-1"></div>
      </div>
      <!-- /.row -->
      <!-- Modal for View Inventory Report -->
            <div class="modal fade" id="modal-success-vendorsForm">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: darkcyan;">
                <button style="color: red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Suppliers Registration</h4>
              </div>
              <div class="modal-body">
                
                            <!-- after form submission, there should be link to Sale Order Form: Form B -->
            <form  method="POST" action="#">
           
              <div class="row">
              <div class="box-body">

              <div class="col-md-6">

                <div class="form-group">
                  <label>First Name<b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="sId">
                </div>
                <div class="form-group">
                  <label >Last Name <b style="color: red">*</b></label>
                  <input type="text" class="form-control" name="sname">
                </div>
                  <div class="form-group">
                  <label >Middle Name(Optional) </label>
                  <input type="text" class="form-control" name="sname">
                </div>
                <div class="form-group">
                  <label>Telephone <b style="color: red">*</b></label>
                  <input type="phone" class="form-control" name="pCategory">
                </div>
               
                 <div class="form-group">
                  <label>Address<b style="color: red">*</b></label>
                  <textarea class="form-control" name="sAddress"></textarea>
                </div>
              </div>



              <div class="col-md-6">
                <div class="form-group">
                  <label>City/State <b style="color: red">*</b></label>
                 <select class="form-control select2" style="width: 100%;">
                    <option disabled selected>--Select State--</option>
                    <option value="Abia">Abia</option>
                    <option value="Adamawa">Adamawa</option>
                    <option value="Akwa Ibom">Akwa Ibom</option>
                    <option value="Anambra">Anambra</option>
                    <option value="Bauchi">Bauchi</option>
                    <option value="Bayelsa">Bayelsa</option>
                    <option value="Benue">Benue</option>
                    <option value="Borno">Borno</option>
                    <option value="Cross Rive">Cross River</option>
                    <option value="Delta">Delta</option>
                    <option value="Ebonyi">Ebonyi</option>
                    <option value="Edo">Edo</option>
                    <option value="Ekiti">Ekiti</option>
                    <option value="Enugu">Enugu</option>
                    <option value="FCT">Federal Capital Territory</option>
                    <option value="Gombe">Gombe</option>
                    <option value="Imo">Imo</option>
                    <option value="Jigawa">Jigawa</option>
                    <option value="Kaduna">Kaduna</option>
                    <option value="Kano">Kano</option>
                    <option value="Katsina">Katsina</option>
                    <option value="Kebbi">Kebbi</option>
                    <option value="Kogi">Kogi</option>
                    <option value="Kwara">Kwara</option>
                    <option value="Lagos">Lagos</option>
                    <option value="Nasarawa">Nasarawa</option>
                    <option value="Niger">Niger</option>
                    <option value="Ogun">Ogun</option>
                    <option value="Ondo">Ondo</option>
                    <option value="Osun">Osun</option>
                    <option value="Oyo">Oyo</option>
                    <option value="Plateau">Plateau</option>
                    <option value="Rivers">Rivers</option>
                    <option value="Sokoto">Sokoto</option>
                    <option value="Taraba">Taraba</option>
                    <option value="Yobe">Yobe</option>
                    <option value="Zamfara">Zamfara</option>
                    </select>

                </div>

                <div class="form-group">
                  <label>Email</label><b style="color: red">*</b>
                  <input type="text" class="form-control" name="brandName">
                </div>

                <div class="form-group">
                  <label>Mobile number (Optional)</label>
                  <input type="mobile" class="form-control" name="pName">
                </div>
                
                 <div class="form-group">
                  <label>Address 2 (Optional)</label>
                  <textarea class="form-control" name="sAddress"></textarea>
                </div>
              </div>
              </div>
            </div>


            <div class="modal-footer" >
                <button style="background-color: darkred;" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button  style="background-color: darkcyan;" type="button" class="btn btn-outline">Register</button>
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
             <div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Supplier Profile</h4>
              </div>
              <div class="modal-body">
                
              <form class="form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="" value="Janifer" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input disabled type="text" name="" value="Mikes@gmail.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input disabled type="text" name="" value="Mikes@gmail.com" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input disabled type="text" name="" value="Janifer" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input disabled type="text" name="" value="081373873" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input disabled type="text" name="" value="No. 1 Olosho street" class="form-control">
                    </div>
                </div>
              </div>

                <div class="modal-footer">
                  <button style="background-color:red" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                  <button data-toggle="modal" data-target="#modal-success-edit" style="background-color: darkcyan;" type="button" class="btn btn-outline">Edit</button>
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
             <div class="modal modal-success fade" id="modal-success-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editing Supplier Profile</h4>
              </div>
              <div class="modal-body">
                
              <form class="form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="" value="Janifer" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input disabled type="text" name="" value="Mikes@gmail.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <input disabled type="text" name="" value="Mikes@gmail.com" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input disabled type="text" name="" value="Janifer" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input disabled type="text" name="" value="081373873" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input disabled type="text" name="" value="No. 1 Olosho street" class="form-control">
                    </div>
                </div>
              </div>

                <div class="modal-footer">
                  <button style="background-color:red" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                  <button data-toggle="modal" data-target="#modal-success" style="background-color: darkcyan;" type="button" class="btn btn-outline">Edit</button>
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