@extends('backend.master')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Categories</li>
            </ol>
        </div>
    </div>

    <!-- Category Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title fs-5">Create Category</h3>
                </div>
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-3">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label fs-4">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name" value="{{ old('name') }}" required style="max-width: 300px;">
                    </div>
                    <div class="card-footer d-flex gap-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- Category Report Header -->
    <div class="d-flex justify-content-between mb-3 flex-wrap align-items-center mt-4">
        <p class="fs-2">Category Report</p>
    </div>

    <!-- Filters: Show Entries & Search -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <!-- Show entries -->
        <form method="GET" action="{{ route('categories.index') }}" class="d-flex align-items-center gap-2 mb-2 mb-md-0">
            <label for="per_page" class="mb-0">Show</label>
            <select name="per_page" id="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                @foreach([10, 25, 50, 100] as $size)
                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            <span>entries</span>
        </form>

        <!-- Search -->
        <form action="{{ route('categories.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search categories..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">Search</button>
        </form>
    </div>

    <!-- Alerts -->
    @include('backend.layout.alert')

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Sr</span>
                            <span>
                                <a href="{{ route('categories.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'id' ? 'desc' : 'asc']) }}">
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
                                <a href="{{ route('categories.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc']) }}">
                                    <i class="fas fa-arrow-up small {{ request('sort_by') === 'name' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                                    <i class="fas fa-arrow-down small {{ request('sort_by') === 'name' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                                </a>
                            </span>
                        </div>
                    </th>
                    <th>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Created At</span>
                            <span>
                                <a href="{{ route('categories.index', ['sort_by' => 'created_at', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'created_at' ? 'desc' : 'asc']) }}">
                                    <i class="fas fa-arrow-up small {{ request('sort_by') === 'created_at' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                                    <i class="fas fa-arrow-down small {{ request('sort_by') === 'created_at' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                                </a>
                            </span>
                        </div>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at ? $category->created_at->format('d-m-Y') : 'N/A' }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div> <!-- Close outermost .container-fluid -->

@endsection


