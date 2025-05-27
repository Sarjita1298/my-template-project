@extends('backend.master')

@section('title', 'Create Blog')

@section('content')
<style>
    .form-control {
        line-height: 1.3;
    }
</style>

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Blog</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('blogs.create')}}">Create Blog</li>
                </ol>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('backend.layout.alert')
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <form id="blogForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Blog Title" required>
                        </div>
                    </div>

                    <!-- Slug -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Auto-generated Slug" required>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control" required></textarea>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Blog Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" onclick="resetForm()">Reset</button>
            </div>
        </div>
    </form>
</section>
@endsection

@section('script')
<script>
    // Auto-generate slug
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('title').addEventListener('input', function () {
            let title = this.value;
            let slug = title.toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')   // Remove special characters
                .replace(/\s+/g, '-')          // Replace spaces with hyphens
                .replace(/-+/g, '-');          // Remove multiple hyphens
            document.getElementById('slug').value = slug;
        });
    });
</script>
{{-- 
<script>
    // Initialize Summernote
    $(document).ready(function () {
        $('#content').summernote({
            height: 200,
            placeholder: 'Write your blog content here...'
        });
    });
</script>

<script>
    // Form Reset Function
    function resetForm() {
        const form = document.getElementById('blogForm');
        form.reset();

        // Reset Summernote content
        $('#content').summernote('code', '');

        // Clear slug manually
        document.getElementById('slug').value = '';
    }
</script> --}}
@endsection
