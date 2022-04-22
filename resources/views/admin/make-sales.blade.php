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
     
      <ol class="breadcrumb">
        <li><a href="admin_Dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row" style="background: #fff">
        <div class="col-md-6" >
        @if(!isset($heldSale->sales_id))

          <h2>Products</h2>
          
          <div id='err' style="display: none" class="alert alert-danger" role="alert">
            <strong>ERROR:</strong> Product already added to customer cart
          </div>
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Selling price</th>
                   <th>Company Name</th>
                   <th>Quantity</th>
                   <th>Selling price</th>
                    <th>Action</th>
                </tr>
                </thead>  

                <tbody>
                @forelse ($products as $product)
                <tr class="tb-hov" style="cursor: cell"  onclick="selectedProduct('{{$product->id}}')">
                  <td id="name{{$product->id}}">{{ $product->name }}</td>
                  <td id="selling_price{{$product->id}}">{{ $product->selling_price }}</td>
                  <td id="company_name{{$product->id}}">{{ $product->comapnay_name }}</td>
                  <td id="in_stock{{$product->id}}">{{ $product->in_stock }}</td>
                  <td id="selling_price{{$product->id}}">{{ $product->selling_price }}</td>
                  <td>
                    <a href="#" class='btn btn-sm btn-primary'><i class='fa fa-plus'></i></a>         
                    <!-- <a href="#" class='btn btn-sm btn-danger' name="delete" ><i class='fa fa-trash'></i></a> -->
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="5">No product for sales yet. Contact the admin to upload more products</td>
                </tr>
                @endforelse
                </tbody>
         
              </table>
              @endif
        </div>

        <div class="col-md-6 bg-info">
        <h2>Customer Cart</h2>
        @inject('selectedProds', 'App\Http\Controllers\SaleController')
              
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

              @if (isset($salesOnHold))
              <div id="msgg" class="alert alert-success">
              {{$salesOnHold}}
            </div>
            <script type="text/javascript">
              setTimeout(function() {document.getElementById('msgg').style.display = 'none'}, 3000);
            </script>
            @endif
            
           
               <form role="form" method="POST" action="{{ route('sales.new') }}">
                 @csrf
                 <table class="table" >
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Quantity</th>
                   <th>Item total</th>
                   <th></th>
                </tr>
                </thead>  
                
                <tbody>
                @forelse ($selectedProds::getProd($products, $_GET['items'] ?? '') as $product1)
                <tr id="{{$product1->id}}" class="cart_items">
                  <td id="name{{$product1->id}}">{{ $product1->name }}</td>
                  <td>
                    <input 
                      id="quantity{{$product1->id}}" 
                      value="{{$heldProducts[$loop->index]->quantity ?? 1}}" 
                      type="number" 
                      {{isset($heldProducts[$loop->index]->quantity) ? 'disabled' : ''}}
                      onchange="updateTotal({{$product1->id}}, {{$product1->selling_price}}, {{$product1->in_stock}})" 
                      min="1" 
                      max="{{ $product1->in_stock }}" 
                      value="1">
                  </td>
                  <td class="item_total" id="item_total{{$product1->id}}">{{$heldProducts[$loop->index]->total_cost ?? $product1->selling_price ?? 1 }}</td>
                  <td>
                    <span style="visibility: hidden" id="unit_cost{{$product1->id}}">{{$product1->unit_cost}}</span>
                    @if(!isset($heldSale->customer_phone))
                    <button title="remove from cart" class="btn btn-danger btn-sm" onclick="removeSelectedItem({{$product1->id}})">-</button>
                    @endif
                  </td>
                </tr>
                
                @if ($loop->last)
                <tr>
                  <td colspan="4">
                    <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <textarea hidden id="all_products" name="all_products"></textarea>
                          <label for="customer_name">Customer name<span style="color:red"> *</span></label>
                          <input type="text" id="customer_name" class="form-control" placeholder="Customer name" value="{{$heldSale->customer_name ?? ''}}" name="customer_name" minlength="1" maxlength="250" required>
                        </div>

                        <div class="col-md-6">
                          <label for="customer_phone">Customer phone<span style="color:red"> *</span></label>
                          <input type="test" id="customer_phone" value="{{$heldSale->customer_phone ?? ''}}" class="form-control" placeholder="Customer phone" name="customer_phone" minlength="11" maxlength="11" required>
                        </div>

                        <div class="col-md-6">
                          <label for="method_of_payment">Method of payment<span style="color:red"> *</span></label>
                          <select id="method_of_payment" class="form-control" name="method_of_payment" required>
                            <option value="Cash">Cash</option>
                            <option value="Bank">Bank</option>
                          </select>
                        </div>

                        <div class="col-md-6">
                          <label for="discount">Discount on sales</label>
                          <input type="number" value="{{$heldSale->discount ?? ''}}" oninput="calculateGrandTotal()" id="discount"  class="form-control" placeholder="0" name="discount" min="0">
                        </div>

                        <div class="col-md-6">
                          <label for="debt">Balance for sales(debt)</label>
                          <input type="number" value="{{$heldSale->debt_balance ?? ''}}" oninput="calculateGrandTotal()" id="debt"  class="form-control" placeholder="0" name="debt" min="0" >
                          @if(isset($heldSale->sales_id))
                          <input type="hidden" value="{{$heldSale->sales_id ?? ''}}" name="sales_id">
                          @endif
                        </div>

                      </div>

                  </td>
                </tr>
                <tr>
                  <td class="text-center" colspan="5">
                    <input id="grand_total2" type="hidden" name="total" value="{{$selectedProds::getProd($products, $_GET['items'] ?? '', true)}}">
                    <h3>TOTAL: {!!$settings->currency!!}<span id="grand_total">{{$selectedProds::getProd($products, $_GET['items'] ?? '', true)}}</span></h3>
                    <!-- <label for="">Put on hold? </label> -->
                    @if(!isset($heldSale->customer_phone))
                    <select name="on_hold" class="form-control-select" style="width:49%;padding:6px">
                      <option value="0">--Put sale on hold(No)?--</option>
                      <option value="0">No</option>
                      <option value="1">Yes</option>
                    </select>
                    @else
                    <input type="hidden" value="0" name="on_hold">
                    <a href="{{'admin/delete/'.$heldSale->sales_id}}" class="btn btn-danger btn-sm" style="width:49%;">Delete this sale  <i class="fa fa-trash" aria-hidden="true"></i> </a>
                    @endif
                    <!-- <button class="btn btn-warning " style="width:49%;">Put on hold</button> -->
                    <x-nav-link :href="route('sales')" style="width:49%;" class="btn btn-danger btn-sm">
                        Make sales
                    </x-nav-link>
                    <!-- <button class="btn btn-danger " style="width:49%;">Cancel sale</button> -->
                    <p></p>
                    <button type="submit" class="btn btn-success btn-lg btn-block">Continue &gt;&gt;</button>
                  </td>
                </tr>
                @endif
                
                @empty
                <tr>
                  <td colspan="5">No product in customer cart yet. Click on products on right hand side to add to cart</td>
                </tr>
                @endforelse
                </tbody>

          </table>
          </form>

        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; {{ date('Y') }} </a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
    var selectedProductsID = getSelected("{{trim($_GET['items'] ?? '')}}")
    var total = 0;
    var allProducts = {};

    @if(!isset($heldSale->sales_id))
      calculateGrandTotal();
      boot();
    @else
      calculateGrandTotal();
      boot();
    @endif


    function boot(){
      //initial
      var cartedItems = document.getElementsByClassName("cart_items");
      var grandTotal = 0;

      for (let i = 0; i < cartedItems.length; i++) {
        var id = cartedItems[i].id
        getAllProductsDetails(
          id,
          Number(document.getElementById('quantity'+id).value), 
          Number(document.getElementById('selling_price'+id).innerHTML),
          Number(document.getElementById('unit_cost'+id).innerHTML)
        );
      }
      
      // document.getElementById('grand_total').innerHTML = grandTotal;
      // return grandTotal
    }

    function getSelected(text){
      var allItems = {}
      var it = text.split(',')
      for (var i = 0; i < it.length; i++) {
        allItems[it[i]] = true;
      }

      return allItems;
    }

    function selectedProduct(selectedID){
      var currentPage = window.location.href
      var splitted = currentPage.split('?items=')
      
      if(selectedProductsID[selectedID] === true) return addStatus(); //stop exec

      if(splitted[1] === undefined) {
        window.location = '?items=' + selectedID, splitted
        return
      }

      window.location = '?items=' + splitted[1] + ',' + selectedID
      return
    }

    function addStatus(){
      document.getElementById('err').style.display = 'block'

      setTimeout(function() {
        document.getElementById('err').style.display = 'none'
      }, 1500);
    }

    function updateTotal(selectedID, sellingPrice, availableGoods){
      //update total
      var selectedQty = document.getElementById('quantity'+selectedID);
      var itemTotal = document.getElementById('item_total'+selectedID);
      var unitCost = document.getElementById('unit_cost'+selectedID);
      // var grandTotal = document.getElementById('grand_total');

      var selectedQty_ = Number(selectedQty.value);
      var itemTotal_ = Number(itemTotal.innerHTML);
      var unitCost_ = Number(unitCost.innerHTML);
      // var grandTotal_ = Number(grandTotal.innerHTML);
      availableGoods = Number(availableGoods)
      sellingPrice = Number(sellingPrice);
      
      if(isNaN(selectedQty_) || selectedQty_ < 1 || selectedQty_ > availableGoods  || isNaN(itemTotal_) || isNaN(unitCost_) || isNaN(sellingPrice)){
        alert('An error just occured. One or more values are not actual numbers')
        return
      }

      itemTotal_ = (sellingPrice * selectedQty_)
      itemTotal.innerHTML = itemTotal_
      
      getAllProductsDetails(selectedID, selectedQty_, sellingPrice, unitCost_)
      // console.log(allProducts)
    }

    function getAllProductsDetails(id, selectedQty_, sellingPrice, unitCost){
      allProducts[id] = {
          productName: document.getElementById('name'+id).innerHTML,
          quantity: selectedQty_,
          selling_price: sellingPrice,
          unit_cost: unitCost,
          total: selectedQty_ * sellingPrice
      }
      document.getElementById('all_products').innerHTML = JSON.stringify(allProducts)
      calculateGrandTotal()
    }

    function calculateGrandTotal(){
      // get all item total and calculate grand total
      var itemTotals = document.getElementsByClassName("item_total");
      var discount = Number(document.getElementById("discount").value);
      var debt = Number(document.getElementById("debt").value);
      var grandTotal = 0;

      for (let i = 0; i < itemTotals.length; i++) {
        grandTotal += Number(itemTotals[i].innerHTML);
      }
      
      var subTotal = grandTotal - (discount + debt)
      
      document.getElementById('grand_total').innerHTML = subTotal;
      document.getElementById('grand_total2').value = grandTotal;
      return grandTotal

    }

    function removeSelectedItem(rowID){
      // remove from cart
      if(selectedProductsID[rowID] === undefined){
        alert('Selected item does not exist')
      }

      // var currentPage = window.location.href.split('?items=')
      // // can be =1 || 1, || ,1 || ,1,
      // if(splitted.length === 1 && splitted[0] === '') {
      //   alert('Cannot remove item')
      //   return
      // }

      // var items = splitted[1].split(',')
      
      // if(items.length === 1 && items[0] === '') {
      //   alert('Cannot remove item2')
      //   return
      // }

      // console.log(selectedProductsID)
      delete selectedProductsID[rowID]
      if(Object.keys(selectedProductsID).length === 0) {
        window.location = window.location.href.split('?items=')[0]
        return
      }
      // console.log(selectedProductsID)
     window.location = '?items='+Object.keys(selectedProductsID).join(',')
      return

      if(selectedProductsID[selectedID] === true) return addStatus(); //stop exec

    if(splitted[1] === undefined) {
      window.location = '?items=' + selectedID, splitted
      return
    }

    window.location = '?items=' + splitted[1] + ',' + selectedID
    return
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

  $.widget.bridge('uibutton', $.ui.button);

    $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
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