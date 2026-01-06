<nav class="navbar navbar-expand-lg">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    <!-- Navbar Header -->
    <div class="navbar-header">
      <a href="{{ route('admin.index') }}" class="navbar-brand">
        <div class="brand-text brand-big text-uppercase">
          <strong class="text-primary">Dark</strong><strong>Admin</strong>
        </div>
        <div class="brand-text brand-sm">
          <strong class="text-primary">D</strong><strong>A</strong>
        </div>
      </a>

      <!-- Sidebar Toggle -->
      <button class="sidebar-toggle">
        <i class="fa fa-long-arrow-left"></i>
      </button>
    </div>

    <!-- Right Menu -->
    <div class="right-menu list-inline no-margin-bottom">

      <!-- Language Switch (Simple) -->
      <div class="list-inline-item dropdown">
        <a href="#" data-toggle="dropdown"
           class="nav-link dropdown-toggle">
          🌐 Language
        </a>

        <div class="dropdown-menu dropdown-menu-right">
          <a href="?lang=en" class="dropdown-item">English</a>
          <a href="?lang=hi" class="dropdown-item">हिंदी</a>
        </div>
      </div>

      <!-- Logout -->
      <div class="list-inline-item logout">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit"
                  class="nav-link"
                  style="background:none;border:none;color:inherit;cursor:pointer;">
            Logout <i class="icon-logout"></i>
          </button>
        </form>
      </div>

    </div>
  </div>
</nav>
