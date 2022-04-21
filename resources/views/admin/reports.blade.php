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
      <!-- Content Header (Page header) -->
      <section class="content-header">
      
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          

          <!-- left column -->
          <div class="col-md-2"></div>


          <div class="col-md-8" style="background: #fff;">
            <!-- general form elements -->
            <h1 class="text-center">{{$settings->business_name}}</h1>
            <h3 class="text-center">{{$title}}</h3>
            <h4 class="text-center"><u>{{$subTitle}}</u></h4>
            @if($showForm)
            <form action="" method="get">
              <div class="row">
                <div class="col-md-4">
                  <label for="start-date">From:</label>
                  <input type="date" name="start-date" id="start-date" class="form-control" required max="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}"  >
                </div>

                <div class="col-md-4">
                  <label for="start-date">To:</label>
                  <input type="date" name="start-date" id="start-date" class="form-control" required max="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" >
                </div>  

                <div class="col-md-4">
                <br>    
                <button class="btn   btn-success">Filter <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>  
              </div>
            </form>
            @endif
            <hr>
            <div class="table-responsive">
            <table class="table table-striped">
           {!!htmlspecialchars_decode($reports)!!}

            
            </table>
          </div>
          </div>

          <div class="col-md-2"></div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


  @include('/footer')
