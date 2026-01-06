<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admincss/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            {{-- Display the authenticated admin's name dynamically --}}
            <h1 class="h5">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</h1>
            {{-- Optionally show the role or usertype if needed --}}
            <p>{{ Auth::check() ? (Auth::user()->usertype ?? 'Admin') : '' }}</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="{{ route('admin.index') }}" > <i class="icon-home"></i>Home </a></li>
                
                {{-- Use named route 'admin.add_post' so URL and middleware are respected --}}
                <li><a href="{{ route('admin.add_post') }}"> <i class="icon-grid"></i>Add post </a></li>

                <li><a href="{{ url('/show_post') }}"> <i class="fa fa-bar-chart"></i>Show Post </a></li>

                <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
        
      </nav>