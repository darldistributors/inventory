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
        
              <!-- <h3 class="box-title text-right"><b style="color:red;"> IMPORTANT</b></h3> -->
              
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="text-right">
                <x-nav-link :href="route('product')" class="btn btn-sm btn-primary">&lt;&lt;Add new product </x-nav-link>

                <!-- <a class="btn btn-primary" href="oute('product')"><i class="fa fa-plus"></i> Add New Product</a> -->
              </div>
              <hr>
              <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endif

            
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Unit cost</th>
                  <th>Stock</th>
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
                  <td>{!!$settings->currency!!}{{ number_format($product->unit_cost) }}</td>
                  <td>{{ number_format($product->in_stock) }}</td>
                  <td>{{ $product->comapnay_name }}</td>
                  <td>{{ $product->company_address }}</td>
                  <td>{{ $product->supplier_name }}</td>
                  <td>{{ $product->supplier_phone }}</td>
                  <td>
                    <a 
                      href="#" 
                      onclick="populateForm('{{ $product->name }}', {{ $product->unit_cost }}, {{ $product->id }}, '{{ $product->supplier_name }}', '{{ $product->supplier_phone }}')" class='btn btn-sm btn-primary' name="delete" data-toggle="modal" data-target="#modal-success-product-edit">Place order   <i class='fa fa-cart-plus'></i></a>
                    <!-- <a href="#" class='btn btn-sm btn-danger' name="delete" ><i class='fa fa-eye'></i></a> -->
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">No products yet. Click on <x-nav-link :href="route('product')" class="btn btn-sm btn-primary">&lt;&lt;new product </x-nav-link> to add new product</td>
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
              <div class="modal-header">
                <button style="color: red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>

                <h4 class="pull-left" style="font-weight: bolder;"><i class="fa fa-plus"></i> New Order</h4>
              </div>
              <div class="modal-body">
            
              <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />
              @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
              @endif

               <form role="form" method="POST" action="{{ route('new.order') }}">
                 @csrf
             <div class="row">
              <div class="box-body">
      
                <div class="form-group">
                <h3 class="text-center" id="productName"></h3>  
                <label>Quantity <b style="color: red">*</b></label>
                  <input type="text" id="id" hidden name="product_id">
                  <input type="text" id="product_name" hidden name="product_name">
                  <input class="form-control" name="orderQuantity" required oninput="getTotal()" id="quantity" placeholder="0" type="number">
                </div>
                
                 <div class="form-group">
                  <label>Unit cost <b style="color: red">*</b></label>
                  <input class="form-control" type="number" min="0" id="unitCost" readonly name="unitCost" placeholder="0" required/>
                </div>

                <div class="form-group">
                  <label>Date <b style="color: red">*</b></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input name="orderDate" type="date" class="form-control" max="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" required>
                </div>
                </div>
                
                <div class="form-group">
                  <label>Supplier name <b style="color: red">*</b></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                  <input list="suppliers" oninput="getPhone()" id="supplierName" autofill="false" name="supplierName" type="text" class="form-control" required>
                  <datalist id="suppliers">
                    @forelse ($suppliers as $supplier)
                      <option value="{{ $supplier->supplier_name }}">
                    @empty
                      <option value="Anonymouse">
                    @endforelse
                  </datalist>
                </div>
                </div>

                <div class="form-group">
                  <label>Supplier phone <b style="color: red">*</b></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                  <input name="supplierPhone" id="supplierPhone" type="tel" class="form-control" required>
                </div>
                </div>

                  <div class="form-group">
                    <label>Total Amount</label>
                    <input type="number" class="form-control" id="total" name="total" readonly required>
                </div>
              </div>
            </div>


                <div class="modal-footer">
                  <button style="background-color:darkred" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                  <button style="background-color: darkcyan;" type="submit" class="btn btn-outline pull-left"><i class="fa fa-cart-plus"></i> Place Order</button>
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
              @csrf
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
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                <button  type="button" class="btn btn-primary">Add</button>
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
    <strong>Copyright &copy; 2020  - <?php echo date("Y"); ?></strong> All rights
    reserved.
</footer>

  
   <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script> 

function populateForm(name, unitCost, id, supplierName, supplierPhone){
  document.getElementById('unitCost').value = unitCost
  document.getElementById('productName').innerHTML = name
  document.getElementById('product_name').value = name
  document.getElementById('id').value = id
  document.getElementById('supplierName').value = supplierName
  document.getElementById('supplierPhone').value = supplierPhone
  // console.log(name, unitCost)
}

function getTotal(){
  let quantity = Number(document.getElementById('quantity').value)
  let unitCost = Number(document.getElementById('unitCost').value)

  document.getElementById('total').value = quantity * unitCost
}


function getPhone(){
  var selectedSupplier = document.getElementById('supplierName').value
  var suppliers = {{ Js::from($suppliers) }}
  var phone = ''

  for (let i = 0; i < suppliers.length; i++) {
    if(suppliers[i].supplier_name.toUpperCase() === selectedSupplier.toUpperCase()){
      phone = suppliers[i].supplier_phone
    }
  }
  document.getElementById('supplierPhone').value = phone
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




  <!-- DataTables -->
<script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>