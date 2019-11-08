<header class="main-header">
    <!-- Logo -->
    <a href="{{('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>UPBJJ</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>APP-L</b>embur</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><i>{{ Auth::user()->name }}</i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="/ChangePasswordUserApp/{{encrypt(Auth::user()->id)}}" class="btn btn-warning"> {{ __('Change Password') }}
                  </a>
                  <a href="{{ route('logout') }}" class="btn btn-danger"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>