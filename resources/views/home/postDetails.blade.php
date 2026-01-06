<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- site metas -->
    <title>A World</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

    <!-- Fancybox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">
</head>

<body>

<!-- ================= HEADER ================= -->
<div class="header_section">
    @include('home.header')
</div>

<!-- ================= POST CONTENT ================= -->
<div class="container mt-5">

    <h1>{{ $post->title }}</h1>

    <p><strong>Author:</strong> {{ $post->name }}</p>

    @if($post->image)
        <img 
            src="{{ asset($post->image) }}" 
            alt="Post Image" 
            class="img-fluid mb-4"
            style="max-width: 500px;"
        >
    @endif

    <p>{{ $post->description }}</p>

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">
        ← Back
    </a>

</div>

<!-- ================= FOOTER ================= -->
@include('home.footer')

<!-- ================= COPYRIGHT ================= -->
<div class="copyright_section">
    <div class="container">
        <p class="copyright_text">
            2020 All Rights Reserved. Design by 
            <a href="https://html.design">Free HTML Templates</a>
        </p>
    </div>
</div>

<!-- ================= JS FILES (FIXED) ================= -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/plugin.js') }}"></script>

<!-- Sidebar -->
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('js/owl.carousel.js') }}"></script>

<!-- Fancybox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>
</html>
