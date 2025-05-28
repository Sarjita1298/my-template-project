@extends('backend.master')

@section('title', 'Edit Report')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('reports.index') }}">Reports</a></li>
                </ol>
            </div>
        </div>

        @include('backend.layout.alert')
    </div>
</section>

<section class="content-header">
    <div class="card card-primary">
        <div class="card-header d-flex">
            <h3 class="card-title">Edit Report</h3>
            <a href="{{ route('reports.index') }}" class="btn btn-dark btn-sm ml-auto">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
        </div>

        <form action="{{ route('reports.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="order_id">Order ID</label>
                <input type="number" name="order_id" class="form-control" value="{{ old('order_id', $report->order_id) }}" required>
            </div>

            <div class="mb-3">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', $report->customer_name) }}" required>
            </div>

            <div class="mb-3">
                <label for="total_price">Total Price</label>
                <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price', $report->total_price) }}" required>
            </div>

            <div class="mb-3">
                <label for="order_date">Order Date</label>
                <input type="date" name="order_date" class="form-control" value="{{ old('order_date', $report->order_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="order_status">Order Status</label>
                <input type="number" name="order_status" class="form-control" value="{{ old('order_status', $report->order_status) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Report</button>
        </form>
    </div>
</section>

@endsection
