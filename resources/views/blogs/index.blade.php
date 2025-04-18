@extends('backend.master')

@section('title', 'Blogs')

@section('content')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blogs</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        {{-- ✅ ALERT SECTION --}}
        @include('backend.layout.alert')

        {{-- Header section --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('blogs.create') }}" class="btn btn-primary">+ Create Blog</a>

            <form method="GET" action="{{ route('blogs.index') }}" class="form-inline">
                <label for="entries" class="mr-2">Show entries:</label>
                <select name="entries" id="entries" onchange="this.form.submit()" class="form-control">
                    <option value="5" {{ request('entries') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
        </div>

        {{-- Table --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>SR</th>
                    <th>Blog Title</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $index => $blog)
                    <tr>
                        <td>{{ ($blogs->currentPage() - 1) * $blogs->perPage() + $index + 1 }}</td>
                        <td>{{ $blog->blog_title }}</td>
                        <td>
                            @if($blog->blog_image)
                            <img src="{{ asset('storage/blogs/' . $blog->image) }}" width="70" class="rounded">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $blog->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No blogs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $blogs->appends(request()->query())->links() }}
        </div>

    </div>
</section>

@endsection
