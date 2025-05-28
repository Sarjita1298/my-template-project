
@extends('backend.master')

@section('title')
Blogs
@endsection()

@section('content')
<style type="text/css">
    .product-overview table {
        width: 100% !important;
        overflow-x: auto;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blogs</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                </ol>
            </div>
        </div>

        @include('backend.layout.alert')
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title fs-3">Blogs Report</h3>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm ml-auto">
                <i class="fas fa-plus"></i> Create Blog
            </a>
        </div>

          <div class="d-flex justify-content-between my-3 mb-3 px-3 flex-wrap align-items-center">
            <form method="GET" action="{{ route('blogs.index') }}" class="d-flex flex-wrap align-items-center gap-2">
                <label for="per_page" class="mb-0">Show</label>
                <select name="per_page" id="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    @foreach([10, 25, 50, 100] as $size)
                        <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>{{ $size }}</option>
                    @endforeach
                </select>
                <span>entries</span>
            </form>

            <form action="{{ route('blogs.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search blogs..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Blog Title</th>
                        <th>Blog Image</th>
                        <th>Created At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach($blogs as $blog)
                        <tr class="text-left">
                            <td>{{ $loop->iteration  }}</td> 
                            <td>{{ $blog->title }}</td>  
                            <td>
                                @if($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded" style="max-height: 50px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $blog->created_at->format('d M, Y') }}</td> 
                            <td class="text-center">
                               <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="getBlogInfo({{ $blog->id }});">
                                <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('blogs.destroy', $blog->id) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

          <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {!! $blogs->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</section>

<!-- Blog Info Modal -->
<div class="modal fade" id="modal-blog-info" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <!-- content loaded dynamically by ajax -->
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="modal-blog-info" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> --}}

@endsection()

@section('script')
<script>
function getBlogInfo(blogId) {
    // Use Laravel route helper with placeholder and replace with id
const url = "{{ route('blogs.info', ':id') }}".replace(':id', blogId);

    $('#modal-blog-info .modal-content').html('<div class="text-center p-5"><i class="fas fa-spinner fa-spin fa-2x"></i> Loading...</div>');

    $('#modal-blog-info').modal('show');

    $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
            $('#modal-blog-info .modal-content').html(data);
        },
        error: function () {
            $('#modal-blog-info .modal-content').html('<div class="alert alert-danger">Failed to load blog info.</div>');
        }
    });
}
</script>
@endsection

{{--  
<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        $('.select2').select2();
    });
    
    const getBlogInfo = (blogSlug) => {
    let url = "{{ route('blogs.show', '__SLUG__') }}".replace('__SLUG__', blogSlug);

    $("#modal-blog-info .modal-dialog .modal-content").load(url, function(response, status) {
        if (status === "success") {
            $('#modal-blog-info').modal('show');
        } else {
            alert("Error loading blog details!");
        }
    });
};

</script>
@endsection() --}}
