<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admincss/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admincss/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admincss/css/font.css">
    <link rel="stylesheet" href="admincss/css/style.default.css">
    <link rel="stylesheet" href="admincss/css/custom.css">

    <style>
        .post_title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px;
            text-align: center;
            color: white;
        }
    </style>
</head>

<body>
<header class="header">   
    @include('admin.header')
</header>

<div class="d-flex align-items-stretch">

    @include('admin.sidebar')

    <div class="page-content">
        <h1 class="post_title">Show Posts</h1>

        @if(session('status'))
            <div class="alert alert-success mx-4">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive" style="margin: 50px;">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Usertype</th>
                        <th>Approve / Reject</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>

                        <td>
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" style="width:100px;">
                            @endif
                        </td>

                        <td>{{ Str::limit($post->description, 80) }}</td>
                        <td>{{ $post->name }}</td>

                        <td>
                            <span class="badge 
                                @if($post->post_status == 'approved') badge-success
                                @elseif($post->post_status == 'pending') badge-warning
                                @else badge-danger
                                @endif">
                                {{ ucfirst($post->post_status) }}
                            </span>
                        </td>

                        <td>{{ $post->usertype }}</td>

                        {{-- APPROVE / REJECT --}}
                        <td>
                            @if($post->post_status == 'pending')
                                <form action="{{ route('admin.approve_post', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>

                                <form action="{{ route('admin.reject_post', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>

                        {{-- EDIT --}}
                        <td>
                            <a href="{{ route('admin.edit_post', $post->id) }}"
                               class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        </td>

                        {{-- DELETE --}}
                        <td>
                            <form action="{{ route('admin.delete_post', $post->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">
                            No posts found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="admincss/vendor/jquery/jquery.min.js"></script>
<script src="admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
