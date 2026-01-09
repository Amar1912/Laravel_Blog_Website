<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Show Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/style.default.css') }}">
</head>

<body>
@include('admin.header')

<div class="d-flex align-items-stretch">
    @include('admin.sidebar')

    <div class="page-content">
        <h2 class="text-center mt-4">Show Posts</h2>

        <div class="table-responsive m-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" width="80">
                            @endif
                        </td>
                        <td>{{ ucfirst($post->post_status) }}</td>
                        <td>
                            <a href="{{ route('admin.edit_post', $post->id) }}"
                               class="btn btn-sm btn-primary">
                               Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.delete_post', $post->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this post?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
