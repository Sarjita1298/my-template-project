@extends('backend.master')
@section('title', 'View Blog')

@section('content')
@include('backend.layout.alert')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blog Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">

        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card shadow-lg p-4 bg-light" style="width: 550px; border-radius: 15px;">
                <h4 class="card-title text-center text-primary mb-4" style="font-weight: bold;">Blog Details</h4>

                <div class="card-body">
                    <p><strong class="text-dark">Title:</strong> <span class="text-secondary">{{ $blog->blog_title }}</span></p>

                    <p><strong class="text-dark">Image:</strong><br>
                        @if ($blog->blog_image)
                            <img src="{{ asset('storage/blogs/' . $blog->blog_image) }}" width="200" class="img-thumbnail mt-2 border border-primary">
                        @else
                            <span class="text-muted">No Image Available</span>
                        @endif
                    </p>

                    <div class="text-center mt-4">
                        <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary px-4">Back to Blogs</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
