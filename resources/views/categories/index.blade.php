@extends('backend.master')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Category</a></li>
            </ol>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3 flex-wrap align-items-center">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
        <form action="{{ route('categories.index') }}" method="GET" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Search categories..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        
    </div>

    @include('backend.layout.alert')

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>S.no</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/category_images/' . $category->image) }}" width="50" height="50" alt="Image">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at ? $category->created_at->format('d-m-Y') : 'N/A' }}</td>
                        <td class="d-flex gap-2">
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $category->id }}">View</button>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modals --}}
    @foreach($categories as $category)
    <div class="modal fade" id="viewModal{{ $category->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel{{ $category->id }}">Category Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><strong>Name:</strong> {{ $category->name }}</div>
                    <div class="mb-3"><strong>Slug:</strong> {{ $category->slug }}</div>
                    <div class="mb-3"><strong>Description:</strong> {{ $category->description ?? 'N/A' }}</div>
                    <div class="mb-3">
                        <strong>Image:</strong><br>
                        @if($category->image)
                            <img src="{{ asset('storage/category_images/' . $category->image) }}" alt="Category Image" class="img-thumbnail mb-2" style="max-width: 300px;">
                            <br>
                            <a href="{{ asset('storage/category_images/' . $category->image) }}" class="btn btn-sm btn-primary" download>Download Image</a>
                        @else
                            <p class="text-muted">No image available.</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-category-select').select2({
            placeholder: "Select categories",
            width: 'resolve',
            closeOnSelect: false
        });
    });
</script>
@endpush
