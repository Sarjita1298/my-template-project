@section('modal-title')
    Order Details - #{{ $report->id }}
@endsection

<div class="modal-header">
    <h5 class="modal-title">@yield('modal-title')</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <tr>
            <th>Customer Name:</th>
            <td>{{ $report->customer_name }}</td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td>₹{{ number_format($report->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Order Date:</th>
            <td>{{ $report->created_at->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Order Status:</th>
            <td>{{ ucfirst($report->order_status) }}</td>
        </tr>
        <tr>
            <th>Return Status:</th>
            <td>{{ ucfirst($report->return_status ?? 'N/A') }}</td>
        </tr>
    </table>
</div>
<div class="modal-footer d-flex justify-content-between align-items-center">
    <small>Created At: {{ $report->created_at->format('d M, Y h:i A') }}</small>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
