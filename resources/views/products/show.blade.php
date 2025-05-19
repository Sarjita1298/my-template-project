@extends('backend.master')
@section('title', 'View Product')

@section('content')
@include('backend.layout.alert')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">

        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card shadow-lg p-4 bg-light" style="width: 550px; border-radius: 15px;">
                <h4 class="card-title bg-primary text-center text-white mb-4 fs-3 fw-light" >Product Details</h4>

                <div class="card-body">
                    <p><strong class="text-dark">Product Name:</strong> <span class="text-secondary">{{ $product->name }}</span></p>
                    <p><strong class="text-dark">Category:</strong> <span class="text-secondary">{{ $product->category->name }}</span></p>

                    <p><strong class="text-dark">Image:</strong><br>
                        @if ($product->product_image)
                            <img src="{{ asset('storage/product_image/' . $product->product_image) }}" width="200" class="img-thumbnail mt-2 border border-primary">
                        @else
                            <span class="text-muted">No Image Available</span>
                        @endif
                    </p>

                    <div class="text-center mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary px-4">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
