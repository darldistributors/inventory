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
        <b>Add new staff</b>
                    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

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
                    <option value="user">User</option>
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
                  <input type="submit" class="btn btn-primary" value="Register">
                  <a href="{{url('admin.dashboard')}}" class="btn btn-danger">Cancel</a>
                 </div>
              </div>

              <div class="col-md-6"></div>

              </div>
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
