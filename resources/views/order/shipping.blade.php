@extends('backend.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('reports.index') }}">Report</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('reports.create') }}">+ Create Report</a></li>

                </ol>
            </div>
        </div>

        @include('backend.layout.alert')
    </div>
</section>
<section class="py-4">
    <div class="container">

        {{-- Page Heading --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Shipping Details for Order #{{ $order->id }}</h2>
        </div>

        {{-- Order Information --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <strong>Order Info</strong>
            </div>
            <div class="card-body">
                <p><strong>Customer Name:</strong> {{ $order->customer_name ?? 'N/A' }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-secondary">{{ ucfirst($order->order_status) }}</span>
                </p>
            </div>
        </div>

        {{-- Flash Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Shipping Update Form --}}
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <strong>Update Shipping Details</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('order.shipping.update', $order->id) }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tracking_number" class="form-label">Tracking Number</label>
                            <input type="text" name="tracking_number" class="form-control" id="tracking_number"
                                value="{{ old('tracking_number', $order->tracking_number) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="carrier" class="form-label">Carrier</label>
                            <input type="text" name="carrier" class="form-control" id="carrier"
                                value="{{ old('carrier', $order->carrier) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="shipping_date" class="form-label">Shipping Date</label>
                            <input type="date" name="shipping_date" class="form-control" id="shipping_date"
                                value="{{ old('shipping_date', optional($order->shipping_date)->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Shipping
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
