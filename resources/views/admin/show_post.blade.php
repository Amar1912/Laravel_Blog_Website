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
        .table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #2b2d31;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            border-radius: 6px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 16px;
            text-align: left;
            border: none;
        }

        .table th {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8c 100%);
            color: #ffffff;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid #444;
            transition: all 0.3s ease;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: #3a3d42;
            transform: scale(1.01);
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .table td {
            color: #e0e0e0;
            font-size: 13px;
        }
        .table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        .table tr:hover {
            background-color: #f1f1f1;
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
       <h1 class="post_title">Show Post</h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>image</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>post status</th>
                            <th>Usertype</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td><img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="width: 100px; height: auto;"></td>
                                <td>{{ $post->description }}</td>   
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->post_status }}</td>
                                <td>{{ $post->usertype }}</td>
                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No posts found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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