@extends('backend.master')

@section('title', 'Edit Product')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@include('backend.layout.alert')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('products.edit', $product->id) }}">Edit Product</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card card-primary">
            <div class="card-header d-flex">
                <h3 class="card-title">Product Info</h3>
                <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm ml-auto">
                    <i class="fas fa-angle-double-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Category -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select class="form-control select2 js-category-select" style="width: 100%;" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Product Name -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                   value="{{ old('product_name', $product->product_name) }}" required>
                        </div>
                    </div>

                    <!-- Discount -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_percentage">Discount Percentage (%)</label>
                            <input type="number" name="discount_percentage" id="discount_percentage" class="form-control"
                                   value="{{ old('discount_percentage', $product->discount_percentage) }}"
                                   min="0" max="100">
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_short_description">Short Description <span class="text-danger">*</span></label>
                            <textarea name="product_short_description" id="product_short_description" class="form-control summernote" required>{{ old('product_short_description', $product->product_short_description) }}</textarea>
                        </div>
                    </div>

                    <!-- Long Description -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_long_description">Long Description <span class="text-danger">*</span></label>
                            <textarea name="product_long_description" id="product_long_description" class="form-control summernote" required>{{ old('product_long_description', $product->product_long_description) }}</textarea>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_price">Product Price <span class="text-danger">*</span></label>
                            <input type="number" name="product_price" id="product_price" class="form-control"
                                   value="{{ old('product_price', $product->product_price) }}" required>
                        </div>
                    </div>

                    <!-- Review Star -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_review_star">Review Star (1-5) <span class="text-danger">*</span></label>
                            <input type="number" name="product_review_star" id="product_review_star" class="form-control"
                                   value="{{ old('product_review_star', $product->product_review_star) }}"
                                   min="1" max="5" required>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_image">Product Image <small class="text-danger">(Size: 525x525px)</small></label>
                            <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*">
                            <input type="hidden" name="oldProductImage" value="{{ $product->product_image }}">

                            @if($product->product_image)
                                <div class="mt-2">
                                    <label>Current Image:</label><br>
                                    <img src="{{ asset('storage/products/' . $product->product_image) }}" width="100" alt="Current Product Image">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</section>
@endsection


@section('script')
<script type="text/javascript">
// $(document).ready(function () {
//     // Initialize Select2
//     $('.js-category-select').select2({
//         placeholder: "Select Category",
//         width: '100%'
//     });

    // Summernote toolbar configuration with font size
    // const summernoteToolbar = [
    //     ['style', ['style']],
    //     ['font', ['bold', 'italic', 'underline', 'clear']],
    //     ['fontsize', ['fontsize']], // 👈 Font size option added here
    //     ['color', ['color']],
    //     ['para', ['ul', 'ol', 'paragraph']],
    //     ['insert', ['link', 'picture', 'video']],
    //     ['view', ['fullscreen', 'codeview', 'help']]
    // ];

    // // Initialize Summernote editors with font size option
    // $('#product_short_description').summernote({
    //     height: 100,
    //     placeholder: 'Enter Short Description',
    //     toolbar: summernoteToolbar
    // });

    // $('#product_long_description').summernote({
    //     height: 200,
    //     placeholder: 'Enter Long Description',
    //     toolbar: summernoteToolbar
    // });

    // Reset button handler
//     $('form').on('reset', function () {
//         var form = this;
//         setTimeout(function () {
//             $(form).find('input[type="text"], input[type="number"], input[type="email"], textarea:not(.summernote)').val('');
//             $(form).find('select.js-category-select').val(null).trigger('change');
//             $(form).find('.summernote').each(function () {
//                 $(this).summernote('code', '');
//             });
//             $(form).find('input[type="file"]').val('');
//         }, 10);
//     });
// });
</script>
@endsection
