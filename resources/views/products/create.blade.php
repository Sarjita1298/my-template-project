@extends('backend.master')

@section('title')
Product Create
@endsection

@section('content')
<style type="text/css">
    #productCatalogue, #productImages, #productImage {
        line-height: 1.3;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('products.create') }}">Product Create</a></li>
                </ol>
            </div>
        </div>

        @include('backend.layout.alert')
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-primary">
            <div class="card-header d-flex">
                <h3 class="card-title">Product Info</h3>
                <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm ml-auto">
                    <i class="fas fa-angle-double-left"></i> Back
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <!-- Category -->
                    <div class="col-md-4">           
                        <div class="form-group">
                            <label for="category_id">Category Name</label>
                            <select class="form-control select2 js-category-select" style="width: 100%;" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Product Name"  required />
                        </div>
                    </div>

                          <!-- Discount -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount_percentage">Discount Percentage (%)</label>
                            <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" placeholder=" Min/Max Discount" min="0" max="100">
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_short_description">Short Description <span class="text-danger">*</span></label>
                            <textarea name="product_short_description" id="product_short_description" class="form-control summernote" placeholder="Enter Short Description" required>{{ old('product_short_description') }}</textarea>
                        </div>
                    </div>

                    <!-- Long Description -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_long_description">Long Description <span class="text-danger">*</span></label>
                            <textarea name="product_long_description" id="product_long_description" class="form-control summernote" placeholder="Enter Long Description" required>{{ old('product_long_description') }}</textarea>
                        </div>
                    </div>

                    <!-- Product Price -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_price">Product Price <span class="text-danger">*</span></label>
                            <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price" required value="{{ old('product_price') }}" />
                        </div>
                    </div>

                    <!-- Review Star -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_review_star">Review Star (1-5) <span class="text-danger">*</span></label>
                            <input type="number" name="product_review_star" id="product_review_star" class="form-control" min="1" max="5" placeholder="Enter Star Rating" required value="{{ old('product_review_star') }}" />
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="product_image">Product Image <small class="text-danger">(Size: 525x525px)</small></label>
                            <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" required />
                        </div>
                    </div>
                </div>
            </div><!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</section>
@endsection
{{-- 
@section('script')
<script>
$(document).ready(function () {
    // Initialize Select2
    $('.js-category-select').select2({
        placeholder: "Select Category",
        width: '100%'
    });

    // Initialize Summernote editors
    $('#product_short_description').summernote({
        height: 100,
        placeholder: 'Enter Short Description'
    });

    $('#product_long_description').summernote({
        height: 200,
        placeholder: 'Enter Long Description'
    });

    // Reset button handler: clear Select2, Summernote, and file input on reset
    $('form').on('reset', function () {
        var form = this;
        setTimeout(function () {
            // Reset Select2 dropdown
            $(form).find('select.js-category-select').val(null).trigger('change');

            // Reset Summernote editors
            $(form).find('.summernote').each(function () {
                $(this).summernote('reset');
            });

            // Reset file inputs
            $(form).find('input[type="file"]').val('');
        }, 10);
    });
});
</script>
@endsection --}}
