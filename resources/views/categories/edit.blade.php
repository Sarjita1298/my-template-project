@extends('backend.master')

@section('title')
Category Edit
@endsection

@section('content')
<div class="container mt-4">
    <h3>Edit Category</h3>

    {{-- Button to trigger modal (optional) --}}
    <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
        Open Edit Form
    </button>

    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        {{-- Display validation errors --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   value="{{ old('name', $category->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug (Optional)</label>
                            <input type="text" name="slug" id="slug" class="form-control" 
                                   value="{{ old('slug', $category->slug) }}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Category Image (Optional)</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if($category->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/category_images/' . $category->image) }}" 
                                         alt="Category Image" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="logs" class="form-label">Logs</label>
                            <textarea name="logs" id="logs" class="form-control">{{ old('logs', $category->logs) }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Optional: Back button --}}
    <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">Back to Categories</a>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if($errors->any())
            // Show modal automatically if there are validation errors
            var modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            modal.show();
        @endif
    });
</script>
@endsection
