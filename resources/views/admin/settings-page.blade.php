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
        <li><a href="{{url('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-10">
          
          <h3>
        <b>Settings</b>
                   

      </h3>
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- form start-->
            <!-- after form submission, there should be link to Sale Order Form: Form B -->
            <x-auth-validation-errors class="alert alert-warning" :errors="$errors" />
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form role="form" method="POST" action="{{ route('settings.update') }}">
                 @csrf
               
            <div class="col-md-6">
              <div class="form-group">        
                  <label for="business_name">Business name</label>
                  <input value="{{$settings->business_name}}" type="text" class="form-control" id="business_name" name="business_name" required/>
              </div>
              <div class="form-group">
                  <label for="contact_phone">Contact phone</label>
                  <input value="{{$settings->contact_phone}}" type="text" maxlength="11" minlength="11" class="form-control" id="contact_phone" name="contact_phone" required/>
              </div>
            </div>

<div class="col-md-6">
        <div class="form-group">
            <label for="contact_email">Contact email</label>
            <input value="{{$settings->contact_email}}" type="email" class="form-control" id="contact_email" name="contact_email" required/>
        </div>
        <div class="form-group">
            <label for="receipt_message">Receipt message</label>
            <input value="{{$settings->receipt_message}}" type="text" class="form-control" id="receipt_message" name="receipt_message" required/>
        </div>
</div>
<div class="col-md-6">
        <div class="form-group">
            <label for="currency">Currency</label>
            <input value="{{$settings->currency}}" type="text" class="form-control" id="currency" name="currency" required/>
            <a href="#"><small><i>Use currency unicode</i></small></a>
        </div>
        <div class="form-group">
            <label for="low_product_alert">Low product alert</label>
            <input value="{{$settings->low_product_alert}}" type="number" min="10" class="form-control" id="low_product_alert" name="low_product_alert" required/>
        </div>
</div>
<div class="col-md-6">

        <div class="form-group">
            <label for="primary_color">Primary color</label>
            <input value="{{$settings->primary_color}}" type="color" class="form-control" id="primary_color" name="primary_color" required/>
        </div>

        <div class="form-group">
            <label for="business_address">Business address</label>
            <textarea class="form-control" id="business_address" name="business_address">{{$settings->business_address}}</textarea>
        </div>
</div>
<div class="col-md-6">
  <button class="btn btn-success btn-lg">Update settings</button>
</div>
<div class="col-md-12">
  <hr>
  ADVANCED
  <hr>
  <button class="btn btn-primary" type="button">SYNC AND BACKUP ONLINE <i class="fa fa-refresh" aria-hidden="true"></i></button>
  <button class="btn btn-danger" type="button">FACTORY RESET <i class="fa fa-trash" aria-hidden="true"></i></button>

</div>
            </form>
        </div>
        </div>
         <div class="col-md-1"></div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@include('/footer')
