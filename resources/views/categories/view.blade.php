@extends('backend.master')

@section('content')
<div class="container d-flex justify-content-center mt-6">
    <div class="card shadow-sm p-4 rounded-4" style="width: 100%; max-width: 450px; color:cornflowerblue">
        <h4 class="text-center mb-3">Category Details</h4>

        <div class="mb-2">
            <label class="fw-bold">Name:</label>
            <div class="form-control bg-light">{{ $category->name }}</div>
        </div>

        <div class="mb-2">
            <label class="fw-bold">Slug:</label>
            <div class="form-control bg-light">{{ $category->slug ?? 'N/A' }}</div>
        </div>

        <div class="mb-3 text-center">
            <label class="fw-bold">Image:</label><br>
            @if($category->image)
                <img src="{{ asset('storage/category_images/' . $category->image) }}" alt="Category Image" class="img-thumbnail mt-2" style="max-height: 180px;">
                <div class="mt-2">
                    <a href="{{ asset('storage/category_images/' . $category->image) }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                    <a href="{{ asset('storage/category_images/' . $category->image) }}" download class="btn btn-outline-success btn-sm ms-2">Download</a>
                </div>
            @else
                <p class="text-muted">No image uploaded</p>
            @endif
        </div>

        <div class="text-center">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm px-4">Back</a>
        </div>
    </div>
</div>
@endsection
