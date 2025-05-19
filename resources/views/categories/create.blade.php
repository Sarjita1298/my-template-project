@extends('backend.master')

@section('content')
<div class="container">
    <h1 class="mb-4 ">Categories</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card-primary">
              <div class="card-header">
                <h3 class="card-title text-bold ">Create Category</h3>
              </div>
        </div>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-3">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name..." value="{{ old('name') }}" required>
        </div>

        {{-- <div class="mb-3">
            <label for="slug" class="form-label">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" class="form-control" placeholder="Custom slug (or leave blank)" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Category Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div> --}}

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-danger">Back to List</a>
        </div>
    </form>
</div>
@endsection
