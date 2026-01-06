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
   <h2>My Posts</h2>

   {{-- success message --}}
   @if(session('status'))
      <div class="alert alert-success">
         {{ session('status') }}
      </div>
   @endif

   {{-- error message --}}
   @if($errors->any())
      <div class="alert alert-danger">
         {{ $errors->first() }}
      </div>
   @endif

   @if($posts->isEmpty())
      <p>No posts found.</p>
   @endif

   @foreach ($posts as $post)
      <div class="card mb-4">
         <div class="card-body">

            <h4>{{ $post->title }}</h4>
            <p>{{ $post->description }}</p>

            @if($post->image)
               <img src="{{ asset($post->image) }}" width="200" class="mb-3">
            @endif

            {{-- ACTION BUTTONS --}}
            <div class="d-flex gap-2">

               {{-- UPDATE BUTTON --}}
               <a href="{{ route('user.edit_post', $post->id) }}"
                  class="btn btn-warning btn-sm">
                  Update
               </a>

               {{-- DELETE BUTTON --}}
               <form action="{{ route('user.delete_post', $post->id) }}"
                     method="POST"
                     onsubmit="return confirm('Are you sure you want to delete this post?');">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-danger btn-sm">
                     Delete
                  </button>
               </form>

            </div>

         </div>
      </div>
   @endforeach
</div>

<!-- footer -->
@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
