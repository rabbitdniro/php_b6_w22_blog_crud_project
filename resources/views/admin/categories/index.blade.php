@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <p>Welcome to the admin dashboard!</p>
        <h2>All Categories</h2>
        <div class="row mt-4">
            <div class="col">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
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
                    <th scope="col">Category ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Update</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this category?');">
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