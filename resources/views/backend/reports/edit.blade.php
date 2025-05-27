@extends('backend.master')

@section('title', 'Shipping details')

@section('content')
<style>
    .form-control {
        line-height: 1.3;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Shipping Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Report</a></li>
                    
                </ol>
            </div>
        </div>

        @include('backend.layout.alert')
    </div>
</section>

<!-- Main content -->
<section class="content">
    
        <div class="card card-primary">
            <div class="card-header d-flex">
                <h3 class="card-title">Report Details</h3>
                <a href="{{ route('reports.index') }}" class="btn btn-dark btn-sm ml-auto">
                    <i class="fas fa-angle-double-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form  method="POST">
    @csrf
    <input type="hidden" name="order_id" value="{{ $report->id }}">
                <div class="row">
                    <!-- Blog Title -->
                   <!-- Courier Company -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="courier_company">Courier Company <span class="text-danger">*</span></label>
                            <input type="text" name="courier_company" id="courier_company" class="form-control" value="{{  old(order) }}" required>
                        </div>
                    </div>

                    <!-- Courier Tracking Number -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="courier_number">Courier Number <span class="text-danger">*</span></label>
                            <input type="text" name="courier_number" id="courier_number" class="form-control" value="{{ old('order_id', $report->order_id) }}"required>
                        </div>
                    </div>

                    <!-- Shipping Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="shipping_date">Shipping Date <span class="text-danger">*</span></label>
                            <input type="date" name="shipping_date" id="shipping_date" class="form-control" required>
                        </div>
                    </div>

                    <!-- Tracking URL -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tracking_url">Tracking URL</label>
                            <input type="url" name="tracking_url" id="tracking_url" class="form-control" placeholder="Enter Tracking URL (Optional)">
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('reports.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </form>
</section>
@endsection()

@section('javaScript')
<script>
    document.getElementById('title').addEventListener('input', function () {
        let title = this.value;
        let slug = title.toLowerCase()
                        .replace(/[^a-z0-9\s]/g, '')  // Remove special characters
                        .replace(/\s+/g, '-')         // Replace spaces with hyphen (-)
                        .replace(/-+/g, '-');         // Remove multiple hyphens

        document.getElementById('slug').value = slug;
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.select2').select2();
        $('#content').summernote({
            height: 200,
            placeholder: 'Enter detailed product description...'
        });
       
    });
</script>
@endsection