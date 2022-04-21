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
        <div class="col-md-10" >
          <h2>Debt history</h2>
          

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
                  <td>{{$debt->debt_id}}</td>
                  <td>{{$debt->description}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->initial_amount)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->total_debt_before)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->total_debt_after)}}</td>
                  <td>{!!$settings->currency!!}{{number_format($debt->amount_paid)}}</td>
                  <td>{{$debt->debt_type}}</td>
                 
                </tr>
                @empty
                <tr>
                  <td colspan="6">No debts yet. Click on <a href="#">new debt</a> to enter a new debt </td>
                </tr>
                @endforelse
                </tbody>

              </table>
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