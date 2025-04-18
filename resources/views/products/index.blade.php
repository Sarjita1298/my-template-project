@extends('backend.master')

@section('title', 'Products')

@section('content')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>    
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>  
                    <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Products</a></li>
                </ol> 
            </div>
        </div>

        {{-- ✅ Alert Message --}}
        @include('backend.layout.alert')
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        {{-- Header & Search --}}
        <div class="d-flex justify-content-between mb-3 flex-wrap align-items-center">
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Create</a>
    
            <form method="GET" action="{{ route('products.index') }}" class="d-flex flex-wrap align-items-center gap-2" style="max-width: 60%;">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Search products by category..." value="{{ request('search') }}" style="width: 200px;">
                <button class="btn btn-sm btn-secondary">Search</button>
            </form>
        </div>

        {{-- Products Table --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Sr</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $key => $product)
                    <tr>
                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->product_image)
                                <img src="{{ asset('storage/product_image/' . $product->product_image) }}" width="60" height="60" alt="Product Image">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-eye"></i> 
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-success">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-danger">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- ✅ Pagination --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->appends(request()->query())->links() }}
        </div>

    </div>
</section>

@endsection
