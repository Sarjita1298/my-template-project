@extends('backend.master')
@section('title', 'Edit Product')

@section('content')
@include('backend.layout.alert')

<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image">Product Image</label>
            <input type="file" name="image" class="form-control">
            @if ($product->image)
                <img src="{{ asset('storage/product_image/' . $product->image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
