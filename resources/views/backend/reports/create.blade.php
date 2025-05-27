@extends('backend.master')

@section('title', 'Create Report')

@section('content')
<div class="container">
    <h1>Create Report</h1>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary mb-3">Back to Reports</a>

    @include('backend.layout.alert')

    <form action="{{ route('reports.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="order_id">Order ID</label>
            <input type="number" name="order_id" class="form-control" value="{{ old('order_id') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" class="form-control" value="{{ old('total_price') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="order_date">Order Date</label>
            <input type="date" name="order_date" class="form-control" value="{{ old('order_date') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="order_status">Order Status</label>
            <input type="text" name="order_status" class="form-control" value="{{ old('order_status') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Save Report</button>
    </form>
</div>
@endsection
