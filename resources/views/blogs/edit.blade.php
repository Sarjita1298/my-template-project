@extends('backend.master')

@section('title', 'Edit Blog')

@section('content')
<style>
    .form-control {
        line-height: 1.3;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Blog</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('blogs.edit', $blog->id) }}">Edit Blog</a></li>
                </ol>
            </div>
        </div>
        @include('backend.layout.alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
<form id="blogForm" action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card card-primary">
        <div class="card-header d-flex">
            <h3 class="card-title">Blog Details</h3>
            <a href="{{ route('blogs.index') }}" class="btn btn-dark btn-sm ml-auto">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Blog Title -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $blog->title }}" name="title" id="title" class="form-control" placeholder="Enter Blog Title" required>
                    </div>
                </div>

                <!-- Blog Slug -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slug">Slug <span class="text-danger">*</span></label>
                        <input type="text" value="{{ $blog->slug }}" name="slug" id="slug" class="form-control" placeholder="Generated Slug" required>
                    </div>
                </div>

                <!-- Blog Content -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Blog Content <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" class="form-control" placeholder="Write your blog here..." required>{{ $blog->content }}</textarea>
                    </div>
                </div>

                <!-- Blog Image -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Blog Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if($blog->image)
                            <div class="mb-4 text-center preview-image">
                                <img src="{{ asset($blog->image) }}" class="img-fluid rounded" style="max-height: 50px;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" onclick="resetForm()" class="btn btn-danger">Reset</button>
        </div>
    </div>
</form>
</section>
@endsection

@section('script')
<script>
    // Auto-slug generation from title
    document.getElementById('title').addEventListener('input', function () {
        let title = this.value;
        let slug = title.toLowerCase()
                        .replace(/[^a-z0-9\s]/g, '')  // Remove special chars
                        .replace(/\s+/g, '-')         // Replace spaces with -
                        .replace(/-+/g, '-');         // Remove multiple -
        document.getElementById('slug').value = slug;
    });

    // // Summernote init
    // $(document).ready(function () {
    //     $('#content').summernote({
    //         height: 200,
    //         placeholder: 'Enter detailed product description...'
    //     });
    // });

    // // Reset form fields manually
    // function resetForm() {
    //     const form = document.getElementById('blogForm');

    //     // Clear text fields
    //     form.querySelector('#title').value = '';
    //     form.querySelector('#slug').value = '';

    //     // Reset Summernote
    //     $('#content').summernote('code', '');

    //     // Clear image input
    //     form.querySelector('#image').value = '';

    //     // Hide image preview
    //     const preview = form.querySelector('.preview-image');
    //     if (preview) {
    //         preview.style.display = 'none';
    //     }
    // }
</script>
@endsection
