<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/font-awesome/css/font-awesome.min.css') }}">

    <!-- Custom Font Icons -->
    <link rel="stylesheet" href="{{ asset('admincss/css/font.css') }}">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

    <!-- Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admincss/css/style.default.css') }}" id="theme-stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('admincss/css/custom.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admincss/img/favicon.ico') }}">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
            font-family: 'Muli', sans-serif;
        }

        .page-content {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .div_center {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .div_center label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .div_center input[type="text"],
        .div_center textarea,
        .div_center input[type="file"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .div_center h1 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .div_center img {
            border-radius: 4px;
            margin-bottom: 15px;
        }

        form > div:last-child {
            margin-top: 20px;
        }

        form > div:last-child .btn {
            padding: 10px 30px;
            font-weight: 600;
        }
    </style>
  </head>

  <body>
    <!-- Header -->
    <header class="header">   
      @include('admin.header')
    </header>

    <!-- Main Layout -->
    <div class="d-flex align-items-stretch">
      <!-- Sidebar -->
      @include('admin.sidebar')

      <!-- Page Content -->
      <div class="page-content p-4 w-100">
         
                  <form action="{{ route('admin.update', $post->id) }}" method="POST" enctype="multipart/form-data">

                      @csrf
                    <div class="div_center">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" value="{{$post->title}}">
                    </div>
                     <div class="div_center">
                        <label for="description">Post description</label>
                        <textarea name="description" rows="4">{{ $post->description }}</textarea>
                    </div>
                     <div class="div_center">
                        <H1>Old Image</H1>
                        <img height="200" width="200" src="/postimage/{{ $post->image }}">
                        <label for="image">Post Image</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <input type="submit" value="Add Post" class="btn btn-primary">
                    </div>

                  </form>

      </div>
    </div>

    <!-- JavaScript Files -->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('js/charts-home.js') }}"></script>
    <script src="{{ asset('js/front.js') }}"></script>
  </body>
</html>
