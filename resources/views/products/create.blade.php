@extends('backend.master')
@section('title', 'Create Product')

@section('content')
@include('backend.layout.alert')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
             <div class="card border-0 shadow rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 shadow-sm d-flex align-items-center justify-content-between">
                <h4 class="mb-0 fw-semibold">Add New Product</h4>
            </div>
             <div class="card-body">

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Create Form --}}
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        {{-- Category --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                           
                                    <select name="category_id" id="category_id" class="form-select" required>
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>


                            <div class="invalid-feedback">Please choose a category.</div>
                        </div>

                        {{-- Product Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter product name..." required>
                            <div class="invalid-feedback">Product name is required.</div>
                        </div>

                        {{-- Image Upload --}}
                        <div class="mb-4">
                            <label for="image" class="form-label">Product Image <small class="text-muted">(optional)</small></label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                ← Back to List
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                Save Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
