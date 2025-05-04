@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <p>Welcome to the admin dashboard!</p>
        <h2>Edit Category</h2>
        <div class="row mt-4">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="name"
                        value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection