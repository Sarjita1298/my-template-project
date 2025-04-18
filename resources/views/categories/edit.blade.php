@extends('backend.master')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Category</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    

        <div class="mb-3">
            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Category Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($category->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/category_images/' . $category->image) }}" alt="Category Image" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endif
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
