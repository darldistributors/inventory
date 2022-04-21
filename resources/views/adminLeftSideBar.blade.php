<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar" >
    <!-- sidebar menu:: style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <!-- <li class="header" style="color: blue; font-size: 18px;">ADMIN NAVIGATION</li>-->
        <li class="treeview">
            @if(Auth::user()->role === 'admin')
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              <i class="fa fa-home"></i>
              <span><b style="font-size: 16px; color: white;">DASHBOARD</b></span>
            </x-nav-link>
            @endif
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-group"></i>
            <span><b style="font-size: 16px; color: white;">ALL MENU</b></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
            
                <!-- <li>
                    <x-nav-link :href="route('admin.staff.new')">
                        <i class="fa fa-plus"></i>New staff
                    </x-nav-link>
                </li> -->
                <li>
                    @if(Auth::user()->role == 'admin')
                    <x-nav-link :href="route('admin.staff.manage')">
                        <i class="fa fa-user"></i>Manage staff
                    </x-nav-link>
                    <x-nav-link :href="route('product')">
                        <i class="fa fa-user"></i>Manage product
                    </x-nav-link>
                    <x-nav-link :href="route('order')">
                        <i class="fa fa-user"></i>Place order
                    </x-nav-link>
                    <x-nav-link :href="route('order.confirm')">
                        <i class="fa fa-user"></i>Confirm order
                    </x-nav-link>
                    <x-nav-link :href="route('inventory')">
                        <i class="fa fa-cart-o"></i>Inventory
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('sales')">
                        <i class="fa fa-money"></i>Make sales
                    </x-nav-link>
                    <x-nav-link :href="route('expenses')">
                        <i class="fa fa-money"></i>Expenses
                    </x-nav-link>

                    <a href="{{url('admin/sales/all')}}">
                        <i class="fa fa-money"></i>All sales
                    </a>
                    <a href="{{url('admin/sales/held-receipt')}}">
                        <i class="fa fa-money"></i>Held Reciept
                    </a>
                    @if(Auth::user()->role === 'admin')
                    <x-nav-link href="{{route('expiring')}}">
                        <i class="fa fa-money"></i>Expiring products
                    </x-nav-link>
                    <x-nav-link href="{{url('admin/debts')}}">
                        <i class="fa fa-money"></i>Debts
                    </x-nav-link>
                    <x-nav-link href="{{url('admin/reports/sales')}}">
                        <i class="fa fa-money"></i>Reports->sales
                    </x-nav-link>
                    <x-nav-link href="{{url('admin/reports/products')}}">
                        <i class="fa fa-money"></i>Reports->products
                    </x-nav-link>
                    <x-nav-link :href="route('settings')">
                        <i class="fa fa-money"></i>Settings
                    </x-nav-link>   
                    @endif
                </li>
            </ul>
        </li>
        <!--li class="treeview"><a href="#" class=""><i class="fa fa-laptop"></i><span style="font-size: 16px; color: white;"><b>REGISTRATION FORMS</b></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li class="treeview"><a href="#" class=""><i class="fa fa-book"></i><span style="font-size: 14px; color: white;">REGISTER PRODUCT</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('admin.productNameForm')}}"><i class="fa fa-edit"></i>Product Name</a></li>
                        <li><a href="{{url('admin.productCategoryForm')}}"><i class="fa fa-edit"></i>Product Category </a></li>
                        <li><a href="{{url('admin.brandNameForm')}}"><i class="fa fa-edit"></i>Brand Name</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"><i class="fa fa-cart-plus"></i><span style="font-size: 14px; color: white;">RETURN PRDOUCT</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('admin.return-Product-CustomerForm')}}"><i class="fa fa-edit"></i>Receive Customer Return</a></li>
                        <li><a href="{{url('admin.return-Product-SupplierForm')}}"><i class="fa fa-edit"></i>Returning to Supplier </a></li>
                    </ul>
                </li>
                <li><a href="{{url('admin.vendorsForm')}}"><i class="fa fa-users"></i><b>Suppliers/Vendors</b></a></li>
                <li><a href="{{url('admin.carriageInwardsForm')}}"><i class="fa fa-forward"></i>Carriage Inward</a></li>
                <li><a href="{{url('admin.carriageOutwardsForm')}}"><i class="fa fa-backward"></i>Carriage Outward</a></li>
                <li><a href="{{url('admin.expensesForm')}}"><i class="fa fa-plus"></i>Expenses</a></li>
                <li><a href="#"><i class="fa fa-plus"></i>Staff</a></li>
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-cart-plus"></i><span><b style="font-size: 16px; color: white;">SELL PRODUCT</b></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li><a href="{{url('admin.customerForm')}}"><i class="fa fa-user"></i>Sell to New Customer</a></li>
                <li><a href="{{url('admin.customerList')}}"><i class="fa fa-cart-plus"></i>Sell to Existing Customer</a></li>
                <li><a href="{{url('admin.recent-Sales')}}"><i class="fa fa-cart-plus"></i>Recent Sales</a></li>
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-cart-plus"></i><span><b style="font-size: 16px; color: white;">ORDER PRODUCT</b></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li><a href="{{url('admin.placeOrderForm')}}"><i class="fa fa-cart-plus"></i>Place Order</a></li>
                <li><a href="{{url('admin.confirmOrderForm')}}"><i class="fa fa-check"></i>Confirm Order</a></li>
                <li><a href="{{url('admin.recent-Orders')}}"><i class="fa fa-cart-plus"></i>Recent Order</a></li>
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-table"></i><span><b style="font-size: 16px; color: white;">REPORTS</b></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li><a href="{{url('admin.inventory-report')}}"><i class="fa fa-circle-o"></i>Inventory Report</a></li>
                <li><a href="{{url('admin.purchase-report')}}"><i class="fa fa-eye"></i>Puchases Order report</a></li>
                <li><a href="{{url('admin.sales-report')}}"><i class="fa fa-eye"></i>Sales Order Report</a></li>
                <li><a href="{{url('admin.customer-report')}}"><i class="fa fa-users"></i>Customers list</a></li>
                <li><a href="{{url('admin.expired-product-report')}}"><i class="fa fa-circle-o"></i>Expired Products</a></li>
                <li><a href="{{url('admin.vendors-report')}}"><i class="fa fa-user"></i>Vendors/Suppliers</a></li>
                <li><a href="{{url('admin.carriageOutwards-report')}}"><i class="fa fa-circle-o"></i><b>Carriage Outwards</b></a></li>
                <li><a href="{{url('admin.carriageInwards-report')}}"><i class="fa fa-circle-o"></i><b>Carriage Inwards</b></a></li>
            </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-pie-chart"></i><span><b style="font-size: 16px; color: white;">CHARTS</b></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Sales</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Profit</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>loss</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Expired Products</a></li>
            </ul>
        </li-->
    </ul>
</section>