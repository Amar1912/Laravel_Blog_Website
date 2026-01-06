<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>A World</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
<link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />
<link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
        @include('home.header');
         <!-- banner section start -->
        <!-- banner section end -->
      </div>
      
      <div>

        <form action="{{ url('user_post') }}" method="POST" enctype="multipart/form-data ">

            @csrf
            <div>
                <label for="">Title</label>
                <input type="text" name="text">
            </div>
             <div>
                <label for="">description</label>
                <textarea name="description" id=""></textarea>
            </div>
             <div>
                <label for="">Add Image</label>
                <input type="fil" name="image">
            </div>
             <div>
                <label for="">Submit</label>
                <input type="submit" value="Add Post">
            </div>
        </form>
      </div>
      

      @include('home.footer');
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>
=======
<head>
    <meta charset="utf-8">
    <title>A World</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/fevicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    <style>
        .post_title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px;
            text-align: center;
            color: white;
        }

        .div_center {
            margin: 20px auto;
            width: 50%;
            display: flex;
            flex-direction: column;
        }

        .div_center label {
            margin-bottom: 8px;
            color: white;
            font-weight: 500;
        }

        .div_center input,
        .div_center textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        form > div:last-child {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<!-- HEADER -->

    @include('home.header');


<!-- PAGE CONTENT -->
<div class="page-content" style="background-color: gray; min-height: 100vh;">
    <h1 class="post_title">Add Post</h1>

    <div class="container">

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('create_post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="div_center">
                <label>Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}">
            </div>

            <div class="div_center">
                <label>Post Description</label>
                <textarea name="description" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="div_center">
                <label>Post Image</label>
                <input type="file" name="image">
            </div>

            <div>
                <input type="submit" value="Add Post" class="btn btn-primary">
            </div>
        </form>

    </div>
</div>

<!-- FOOTER -->
@include('home.footer')

<!-- jQuery (load only once) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>

<!-- Popper -->
<script src="{{ asset('js/popper.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('js/plugin.js') }}"></script>

<!-- Sidebar / Scrollbar -->
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('js/owl.carousel.js') }}"></script>

<!-- Fancybox (CDN) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

<!-- Custom JS (keep last) -->
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
>>>>>>> today-broken-backup
