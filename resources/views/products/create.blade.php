@extends('backend.master')
@section('title', 'Create Product')

@section('content')
@include('backend.layout.alert')

<div class="container">
    <h3 class="mb-4">Add New Product</h3>

  
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-3">
        @csrf


        <div class="mb-3">
            <label for="category_id" class="form-label">Select Category <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

           <div class="mb-3">
            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter product name..." value="{{ old('name') }}" required>
        </div>

      
        <div class="mb-3">
            <label for="image" class="form-label">Product Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>


        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Create Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </form>
</div>
@endsection
