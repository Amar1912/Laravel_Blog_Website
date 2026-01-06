<!DOCTYPE html>
<html lang="en">
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
