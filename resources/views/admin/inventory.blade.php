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
        
              <h3 class="box-title text-right"><b> <i class="fa fa-dashboard"> Existing Inventory </i></b></h3>
  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!--div class="text-right">
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-success-new-inventory">Add New Inventory</a>
              </div-->
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
                  <th>Product Name</th>
                   <th>Qty. In Stock</th>
                   <th title="How much it was purchased from supplier per unit">Unit Cost</th>
                   <th>Selling Price</th>
                   <th>Status</th>
                   <th>Last update</th>
                   <th>Action</th>
                </tr>
                </thead>  

                <tbody>
                @forelse ($inventory as $inv)
                <tr>
                  <td>{{ $inv->name }}</td>
                  
                  @if ($inv->in_stock >= 100)
                  <td class="alert-success">{{ number_format($inv->in_stock) }}</td>
                  @elseif ($inv->in_stock < 100 && $inv->in_stock > 50)
                  <td class="alert-warning">{{ number_format($inv->in_stock) }}</td>
                  @else
                  <td class="alert-danger">{{ number_format($inv->in_stock) }}</td>
                  @endif

                  <td>{!!$settings->currency!!}{{ number_format($inv->unit_cost) }}</td>
                  <td>{!!$settings->currency!!}{{ number_format($inv->selling_price) }}</td>

                  @if ($inv->out_of_stock == 0)
                  <td class="alert-success"><i class="fa fa-check"></i><small>Available for sales</small></td>
                  @else
                  <td class="alert-danger"><i class="fa fa-times"></i><small>Unavailable for sales</small></td>
                  @endif
                  <td>{{ $inv->updated_at }}</td>
                  <td>   
                    <a href="#" onclick="populateForm('{{$inv->id}}', '{{$inv->name}}', {{$inv->unit_cost}}, {{ $inv->selling_price }}, {{ $inv->in_stock }})" class='btn btn-sm btn-primary' name="delete" data-toggle="modal" data-target="#modal-success-product-edit"><i class='fa fa-edit'></i></a>         
                    <a href="#" class='btn btn-sm btn-danger' name="delete" ><i class='fa fa-trash'></i></a>
                 </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7">No inventory yet. Click on <a href="#">new inventory</a> to create inventory </td>
                </tr>
                @endforelse
                </tbody>

                <tr>
                <!-- </tr> -->
         
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

                <h4 class="text-center" style="font-weight: bolder;">{{$settings->business_name ?? 'INVENTORY'}}<br>Editing Inventory System</h4>
              </div>
              <div class="modal-body">
                  
            <form role="form" method="POST" action="{{ route('inventory.edit') }}">
            @csrf  
              <div class="row">
              <div class="box-body">
                 <div class="form-group">
                   <h3 class="text-center" id="product_name"></h3>
                </div>
                <div class="form-group">
                  <label >Unit cost Price</label>
                  <input type="text" hidden id="product_id" name="product_id">
                  <input type="text" class="form-control" id="unit_cost" readonly>
                </div>
                <div class="form-group">
                  <label> Selling price <b style="color: red">*</b></label>
                  <input type="text" class="form-control" id="selling_price" name="selling_price" required>
                </div>
                <div class="form-group">
                  <label for="product_quantity"> Product quantity <b style="color: red">*</b></label>
                  <input type="text" class="form-control" id="product_quantity" name="product_quantity">
                </div>
               
                 <div class="form-group">
                  <label>Make available for sales<b style="color: red">*</b>
                  <input type="checkbox" class="form-control-checkbox" name="out_of_stock" checked>
                  </label>
                </div>
              </div>
              </div>

 
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                <button  type="submit" class="btn btn-primary">Update</button>
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
          <div class="modal fade" id="modal-success-new-inventory">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color:darkcyan">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>New Inventory</b></h4>
              </div>
              <div class="modal-body">

          <!-- after form submission, there should be link to Sale Order Form: Form B -->
            <form  method="POST" action="#">
           
              <div class="row">
              <div class="box-body">
                 <div class="form-group">
                  <label>Product Name<b style="color: red">*</b></label>
                  <select class="form-control select2" style="width: 100%;">
                    <option disabled selected>--Select--</option>
                    <option value="Abia">Beans</option>
                    <option value="Zamfara">Yam</option>
                    </select>
                </div>
                <div class="form-group">
                  <label >Quantity <b style="color: red">*</b></label>
                  <input type="text" min="1" class="form-control" name="purchaseDetailsQuantity" id="purchaseDetailsQuantity">
                </div>
                  <div class="form-group">
                  <label >Unit cost Price</label>
                  <input type="text" class="form-control" name="purchaseDetailsUnitCostPrice" id="purchaseDetailsUnitCostPrice">
                </div>
                <div class="form-group">
                  <label> Unit Selling Price <b style="color: red">*</b></label>
                  <input class="form-control" id="purchaseDetailsUnitSellingPrice" name="purchaseDetailsUnitSellingPrice">
                </div>

                <div class="form-group">
                  <label> Total Cost Price <b style="color: red">*</b></label>
                  <input type="text" class="form-control" id="purchaseDetailsTotalCostPrice" name="purchaseDetailsTotalCostPrice">
                </div>
               
                 <div class="form-group">
                  <label>Expected Sales Amount<b style="color: red">*</b></label>
                  <input type="text" class="form-control" id="purchaseDetailsAmountExpected" name="purchaseDetailsAmountExpected">
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
    <strong>Copyright &copy; 2020  - <?php echo date("Y"); ?> <a target="_blank" href="#">Darl Distributors</a>.</strong> All rights
    reserved.
</footer>

  
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
  function populateForm(id, name, unitCost, sellingPrice, quantity){
    document.getElementById('product_id').value = id
    document.getElementById('product_name').innerHTML = name
    document.getElementById('unit_cost').value = unitCost
    document.getElementById('selling_price').value = sellingPrice
    document.getElementById('product_quantity').value = quantity
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

<!-- Autocalculation -->
<!-- Custom scripts -->
  <script src="/vendor/auto/scripts.js"></script>




  <!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>