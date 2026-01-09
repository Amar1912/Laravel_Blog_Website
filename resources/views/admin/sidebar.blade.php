<nav id="sidebar">
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ asset('admincss/img/avatar-6.jpg') }}"
                 alt="Admin"
                 class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">{{ Auth::user()->name }}</h1>
            <p>{{ Auth::user()->usertype }}</p>
        </div>
    </div>

    <span class="heading">Main</span>

    <ul class="list-unstyled">
        <li>
            <a href="{{ route('admin.index') }}">
                <i class="icon-home"></i> Home
            </a>
        </li>

        <li>
            <a href="{{ route('admin.add_post') }}">
                <i class="icon-grid"></i> Add Post
            </a>
        </li>

        <li>
            <a href="{{ route('admin.show_post') }}">
                <i class="fa fa-bar-chart"></i> Show Posts
            </a>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-left">
                    <i class="icon-logout"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
