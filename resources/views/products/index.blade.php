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
            <p class="fs-4">Product Report</p>
    
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ Create</a>

        </div>
         <div class="container-fluid">

        {{-- Header & Search --}}
     <div class="d-flex justify-content-between mb-3 flex-wrap align-items-center">
    <form method="GET" action="{{ route('products.index') }}" class="d-flex flex-wrap align-items-center gap-2">
        <label for="per_page" class="mb-0">Show</label>
        <select name="per_page" id="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
            @foreach([10, 25, 50, 100] as $size)
                <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
            @endforeach
        </select>
        <span>entries</span>
    </form>
    
       <!-- Right side: Search bar -->
            <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search categories..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </form>    
        </div>

        {{-- Products Table --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <thead class="table-light">
    <tr>
        <th>
            <div class="d-flex justify-content-between align-items-center">
                <span>Sr</span>
                <span>
                    <a href="{{ route('products.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'id' ? 'desc' : 'asc']) }}">
                        <i class="fas fa-arrow-up small {{ request('sort_by') === 'id' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                        <i class="fas fa-arrow-down small {{ request('sort_by') === 'id' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                    </a>
                </span>
            </div>
        </th>

        <th>
            <div class="d-flex justify-content-between align-items-center">
                <span>Category Name</span>
                <span>
                    <a href="{{ route('products.index', ['sort_by' => 'category_id', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'category_id' ? 'desc' : 'asc']) }}">
                        <i class="fas fa-arrow-up small {{ request('sort_by') === 'category_id' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                        <i class="fas fa-arrow-down small {{ request('sort_by') === 'category_id' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                    </a>
                </span>
            </div>
        </th>

        <th>
            <div class="d-flex justify-content-between align-items-center">
                <span>Product Name</span>
                <span>
                    <a href="{{ route('products.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc']) }}">
                        <i class="fas fa-arrow-up small {{ request('sort_by') === 'name' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                        <i class="fas fa-arrow-down small {{ request('sort_by') === 'name' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                    </a>
                </span>
            </div>
        </th>

        <th>Product Image</th>

        <th>
            <div class="d-flex justify-content-between align-items-center">
                <span>Created At</span>
                <span>
                    <a href="{{ route('products.index', ['sort_by' => 'created_at', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'created_at' ? 'desc' : 'asc']) }}">
                        <i class="fas fa-arrow-up small {{ request('sort_by') === 'created_at' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                        <i class="fas fa-arrow-down small {{ request('sort_by') === 'created_at' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                    </a>
                </span>
            </div>
        </th>

        <th>Action</th>
    </tr>
</thead>

            </thead>
            <tbody>
                @forelse ($products as $key => $product)
                    <tr>
                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if (!empty($product->product_image))
                                <img src="{{ url('my-template-project/public/storage/product_image/' . $product->product_image) }}" width="60" height="60" alt="Product Image">
                            @else
                                <span>No Image</span>
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
