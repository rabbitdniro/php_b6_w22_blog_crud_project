@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <p>Welcome to the admin dashboard!</p>
        <h2>Create Blog Posts</h2>
        <div class="row mt-4">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="title" name="post_title" required>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Post Content</label>
                    <textarea class="form-control" id="content" name="post_content" rows="5" required></textarea>
                    @error('content')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Post Category</label>
                    <select class="form-select" id="category" name="category_id" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <img id="user_image" src="" class="img-fluid img-thumbnail" alt="" width="72px" height="72px">
                    <br>
                    <label for="image" class="form-label">Post Image</label>
                    <input type="file" class="form-control" id="image" name="featured_image" accept="image/*"
                        oninput="user_image.src = window.URL.createObjectURL(this.files[0])">
                    @error('featured_image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Save Post</button>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection