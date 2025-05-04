@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <p>Welcome to the admin dashboard!</p>
        <h2>All Blog Posts</h2>
        <div class="row mt-4">
            <div class="col">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endsession

    <div class="container mt-5">
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Post ID</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Post Content</th>
                    <th scope="col">Post Category</th>
                    <th scope="col">Post Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->post_title }}</td>
                        <td>{{ Str::limit($post->post_content, 50) }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            @if ($post->featured_image)
                                <img src="{{ asset($post->featured_image) }}" alt="Post Image" class="img-fluid" width="72px"
                                    height="72px">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Update</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this post?');">
                                {{-- CSRF token for form submission --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection