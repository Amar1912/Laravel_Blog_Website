<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>A World</title>

   <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>

<!-- header -->
<div class="header_section">
   @include('home.header')
</div>

<div class="container mt-4">
    <h2>Edit Post</h2>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('user.update_post', $post->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ $post->title }}"
                   required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description"
                      class="form-control"
                      rows="4"
                      required>{{ $post->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">

            @if($post->image)
                <img src="{{ asset($post->image) }}" width="150" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            Update Post
        </button>

        <a href="{{ route('user.my_posts') }}" class="btn btn-secondary">
            Cancel
        </a>
    </form>
</div>

<!-- footer -->
@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
