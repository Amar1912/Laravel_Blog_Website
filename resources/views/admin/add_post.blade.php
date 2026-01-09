<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/style.default.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/custom.css') }}">
</head>

<body>
<header class="header">
    @include('admin.header')
</header>

<div class="d-flex align-items-stretch">
    @include('admin.sidebar')

    <div class="page-content">
        <h1 class="post_title text-center mt-4">Add Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger mx-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success mx-4">{{ session('status') }}</div>
        @endif

        <form action="{{ route('admin.add_post.store') }}" method="POST" enctype="multipart/form-data" class="m-4">
            @csrf
            <div class="form-group">
                <label>Post Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
    </div>
</div>

<script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
