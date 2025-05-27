@extends('backend.master')

@section('title')
Category 
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('categories.create')}}">Create Category</a></li>
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

<div class="container-fluid">
    <!-- Breadcrumb -->
    {{-- <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
            </ol>
        </div>
    </div> --}}

    <!-- Category Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header d-flex align-items-center">
                <h3 class="card-title fs-5 mb-0">Create Category</h3>
                {{-- <div class="ms-auto">
                    <a href="{{ route('categories.index') }}" class="btn btn-dark btn-sm">
                        <i class="fas fa-angle-double-left"></i> Back
                    </a>
                </div> --}}
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
        <p class="fs-2 text-dark">Category Report</p>
    </div>

    <!-- Filters: Show Entries & Search -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <!-- Show entries -->
        <form method="GET" action="{{ route('categories.index') }}" class="d-flex align-items-center gap-2 mb-2 mb-md-0">
            <label for="per_page" class="mb-0 text-dark">Show</label>
            <select name="per_page" id="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                @foreach([10, 25, 50, 100] as $size)
                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            <span class="text-dark mb-0">entries</span>
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
                            <span>Sr.</span>
                            {{-- <span>
                                <a href="{{ route('categories.index', ['sort_by' => 'id', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'id' ? 'desc' : 'asc']) }}">
                                    <i class="fas fa-arrow-up small {{ request('sort_by') === 'id' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                                    <i class="fas fa-arrow-down small {{ request('sort_by') === 'id' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                                </a>
                            </span> --}}
                        </div>
                    </th>
                    <th>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Category Name</span>
                            {{-- <span>
                                <a href="{{ route('categories.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc']) }}">
                                    <i class="fas fa-arrow-up small {{ request('sort_by') === 'name' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                                    <i class="fas fa-arrow-down small {{ request('sort_by') === 'name' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                                </a>
                            </span> --}}
                        </div>
                    </th>
                    <th>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Created At</span>
                            {{-- <span>
                                <a href="{{ route('categories.index', ['sort_by' => 'created_at', 'sort_order' => request('sort_order') === 'asc' && request('sort_by') === 'created_at' ? 'desc' : 'asc']) }}">
                                    <i class="fas fa-arrow-up small {{ request('sort_by') === 'created_at' && request('sort_order') === 'asc' ? 'text-dark' : 'text-muted' }}"></i>
                                    <i class="fas fa-arrow-down small {{ request('sort_by') === 'created_at' && request('sort_order') === 'desc' ? 'text-dark' : 'text-muted' }}"></i>
                                </a>
                            </span> --}}
                        </div>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse($categories as $index => $category) --}}
                  @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at ? $category->created_at->format('d-m-Y') : 'N/A' }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                    Edit
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name{{ $category->id }}" class="form-label">Category Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" id="name{{ $category->id }}" class="form-control" value="{{ old('name', $category->name) }}" required>
                                                </div>

                                                {{-- <div class="mb-3">
                                                    <label for="slug{{ $category->id }}" class="form-label">Slug (Optional)</label>
                                                    <input type="text" name="slug" id="slug{{ $category->id }}" class="form-control" value="{{ old('slug', $category->slug) }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="image{{ $category->id }}" class="form-label">Category Image (Optional)</label>
                                                    <input type="file" name="image" id="image{{ $category->id }}" class="form-control">
                                                    @if($category->image)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/category_images/' . $category->image) }}" class="img-thumbnail" style="max-height: 150px;" alt="Category Image">
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <label for="logs{{ $category->id }}" class="form-label">Logs</label>
                                                    <textarea name="logs" id="logs{{ $category->id }}" class="form-control">{{ old('logs', $category->logs) }}</textarea>
                                                </div>
                                            </div> --}}

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                  @endforeach

                {{-- @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No categories found.</td>
                    </tr>
                @endforelse --}}
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {!! $categories->links('pagination::bootstrap-5') !!}
    </div>
</div> <!-- Close outermost .container-fluid -->

@endsection


