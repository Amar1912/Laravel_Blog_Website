 <div class="header_main">
            <div class="mobile_menu">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <div class="logo_mobile"><a href="index.html"><img src="images/logo.png"></a></div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="services.html">Services</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="blog.html">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="contact.html">Contact</a>
                        </li>
                        
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="container-fluid">
               <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
               <div class="menu_main">
                  <ul>
                     <li class="active"><a href="index.html">Home</a></li>
                     <li><a href="about.html">About</a></li>
                     <li><a href="services.html">Services</a></li>
                     <li><a href="blog.html">Blog</a></li>
                     

                     {{--
                        Guest vs Auth menu behavior:
                        - Guests: show 'Login' and 'Register' links so unauthenticated visitors can sign in or sign up.
                        - Authenticated users: show only a POST 'Logout' button (with CSRF) to safely log out.

                        Why: after login we redirect users to the public homepage ('home.homepage'), and that page
                        (and other authenticated views) should hide Login/Register and display Logout only. This keeps
                        the UI consistent across pages (homepage and dashboard).
                     --}} 
                     @guest
                        @if (Route::has('login'))
                           <li><a href="{{ route('login') }}">Login</a></li> {{-- Guest: show Login --}}
                        @endif

                        @if (Route::has('register'))
                           <li><a href="{{ route('register') }}">Register</a></li> {{-- Guest: show Register --}}
                        @endif
                     @endguest

                     @auth
                        {{-- Authenticated users (both normal users and admins) see only Logout --}}
<<<<<<< HEAD
                        <li><a href="{{ url('create_post') }}">Create Post</a></li>
=======
                        <li><a href="{{ route('create_post') }}">CREATE POST</a></li>
                        <li>
    <a href="{{ route('user.my_posts') }}">MY POSTS</a>
</li>

>>>>>>> today-broken-backup
                        <li>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;">Logout</button> {{-- Auth: Logout button (POST) --}}
                           </form>
                        </li>
                     @endauth
                  </ul>
               </div>
            </div>
         </div>