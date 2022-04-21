
<header class="main-header" >
    <!-- Logo -->
    <x-nav-link class="logo" :href="route('dashboard')" style="background: {{$settings->primary_color ?? '#000'}}">
      <span class="logo-lg"><b>{{$settings->business_name ?? 'INVENTORY'}}</b> </span>
    </x-nav-link>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background: {{$settings->primary_color ?? '#000'}};">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>


      <div class="navbar-custom-menu" style="background: {{$settings->primary_color ?? '#000'}};">
        <ul class="nav navbar-nav" >    
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
            </a>
            <ul class="dropdown-menu" >
              <!-- User image -->
              <li class="user-header" style="background: {{$settings->primary_color ?? '#000'}};">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                     

                <p>
                  <h4>{{ Auth::user()->name }}</h4>
                  <small>Registered: {{ Auth::user()->created_at }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="'#'" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout', []) }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>