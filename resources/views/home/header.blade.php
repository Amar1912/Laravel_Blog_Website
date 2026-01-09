<div class="header_main">
    <div class="mobile_menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo_mobile">
                <a href="{{ route('home.homepage') }}">
                    <img src="{{ asset('images/logo.png') }}">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.homepage') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.homepage') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.homepage') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.homepage') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.homepage') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="logo">
            <a href="{{ route('home.homepage') }}">
                <img src="{{ asset('images/logo.png') }}">
            </a>
        </div>

        <div class="menu_main">
            <ul>
                <li class="active">
                    <a href="{{ route('home.homepage') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('home.homepage') }}">About</a>
                </li>
                <li>
                    <a href="{{ route('home.homepage') }}">Services</a>
                </li>
                <li>
                    <a href="{{ route('home.homepage') }}">Blog</a>
                </li>

                {{-- AUTH / GUEST LINKS --}}
                @guest
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endif

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @endguest

                @auth
                    <li>
                        <a href="{{ route('home.create_post') }}">CREATE POST</a>
                    </li>

                    <li>
                        <a href="{{ route('home.my_posts') }}">MY POSTS</a>
                    </li>

                    <li>
                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            <button type="submit"
                                    style="background:none;border:none;padding:0;color:inherit;cursor:pointer;">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
