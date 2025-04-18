@extends('backend.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Add New Blog</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @include('backend.layout.alert')
        </div>
    @endif

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-3">
        @csrf

        <div class="mb-3">
            <label for="blog_title" class="form-label">Blog Name <span class="text-danger">*</span></label>
            <input type="text" name="blog_title" id="blog_title" class="form-control" placeholder="Enter blog name..." value="{{ old('blog_title') }}" required>
        </div>

        <div class="mb-3">
            <label for="blog_image" class="form-label">Blog Image (Optional)</label>
            <input type="file" name="blog_image" id="blog_image" class="form-control">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Create Blog</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </form>
</div>
@endsection
