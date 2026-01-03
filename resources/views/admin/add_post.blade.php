<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admincss/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admincss/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="admincss/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="admincss/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="admincss/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="admincss/img/favicon.ico">
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

        .div_center input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        form {
            padding: 20px;
        }

        form > div:last-child {
            margin: 20px auto;
            width: 50%;
            text-align: center;
        }
        
    </style>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      @include('admin.header')
    </header>

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
        <div class="page-content">
               <h1 class="post_title">Add Post</h1>

               <div>

                {{-- Show validation errors and status messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form action="{{ route('admin.add_post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_center">
                        <label for="title">Post Title</label>
                        <input type="text" name="title" value="{{ old('title') }}">
                    </div>
                     <div class="div_center">
                        <label for="description">Post description</label>
                        <textarea name="description" rows="4">{{ old('description') }}</textarea>
                    </div>
                     <div class="div_center">
                        <label for="image">Post Image</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <input type="submit" value="Add Post" class="btn btn-primary">
                    </div>
                </form>
               </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="admincss/vendor/jquery/jquery.min.js"></script>
    <script src="admincss/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admincss/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="admincss/vendor/chart.js/Chart.min.js"></script>
    <script src="admincss/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>