@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <p>Welcome to the admin dashboard!</p>
        <h2>Create Category</h2>
        <div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection