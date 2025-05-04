@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center my-5">
            <h1>Welcome to the Blog</h1>
            <p>This is a simple blog application built with Laravel.</p>
        </div>

        <div class="row">

            @foreach($posts as $post)
                <div class="col">
                    <div class="card mb-5" style="width: 18rem;">

                        <img src="{{ $post->featured_image }}" class="card-img-top" alt="..."
                            style="width: 288px; height: 150px;">

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->post_title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($post->post_content, 50) }}
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">By: {{ $post->user->name }}</li>
                        </ul>

                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
@endsection