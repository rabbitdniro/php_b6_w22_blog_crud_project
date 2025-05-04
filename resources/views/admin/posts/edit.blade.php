@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <div class="row mt-4">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" class="form-control" id="title" name="post_title"
                        value="{{ old('post_title', $post->post_title) }}" required>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Post Content</label>
                    <textarea class="form-control" id="content" name="post_content" rows="5"
                        required>{{ old('post_content', $post->post_content) }}</textarea>
                    @error('content')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Post Category</label>
                    <select class="form-select" id="category" name="category_id" required>
                        <option value="" disabled>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <img id="user_image" src="{{ asset($post->featured_image) }}" class="img-fluid img-thumbnail" alt=""
                        width="72px" height="72px">
                    <br>
                    <label for="image" class="form-label">Post Image</label>
                    <input type="file" class="form-control" id="image" name="featured_image"
                        oninput="user_image.src = window.URL.createObjectURL(this.files[0])">
                    @error('featured_image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection