@extends('backend.master')

@section('title')
Report
@endsection

@section('content')
<style>
    .product-overview table {
        width: 100% !important;
        overflow-x: auto;
    }
</style>

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
                </ol>
            </div>
        </div>

        @include('backend.layout.alert')
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title fs-3">Report File</h3>
            <a href="{{ route('reports.create') }}" class="btn btn-primary btn-sm ml-auto">
                <i class="fas fa-plus"></i> Create Report
            </a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->customer_name }}</td>
                            <td>₹{{ number_format($report->total_price, 2) }}</td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                            <td>{{ $report->order_status == 'shipped' ? 'Pending' : 'Shipped' }}</td>
                            <td class="text-center">
                                <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="{{ route('order.shipping', ['id' => $report->id]) }}" class="btn btn-success btn-sm" title="Update Shipping">
                                    <i class="fas fa-truck"></i>
                                </a>



                              <!-- Eye Button -->
                                <button type="button" class="btn btn-primary btn-sm" onclick="getOrderInfo({{ $report->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>


                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                <form action="{{ route('order.status.toggle', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="order_status" value="{{ $report->order_status == 'shipped' ? 'pending' : 'shipped' }}">
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-sync-alt"></i> 
                                    </button>
                                </form>

 
                                @if ($report->return_status == 'requested')
                                    <form action="{{ route('return.approve', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('return.reject', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                @endif

                                @if ($report->return_status == 'approved')
                                    <form action="{{ route('return.picked', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-box"></i> Picked
                                        </button>
                                    </form>
                                @endif

                                @if ($report->return_status == 'picked')
                                    <form action="{{ route('return.refund', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fas fa-undo"></i> Refund
                                        </button>
                                    </form>
                                @endif

                                @if ($report->return_status == 'refunded')
                                    <form action="{{ route('return.complete', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check-double"></i> Complete
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


<!-- Modal for Order Info -->
<div class="modal fade" id="modal-order-info" tabindex="-1" aria-labelledby="modalOrderInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- AJAX content will be injected here -->
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    $(function () {
        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
        });
    });

    function getOrderInfo(orderId) {
        let url = "{{ route('reports.info', ':id') }}".replace(':id', orderId);

        // Loading state
        $("#modal-order-info .modal-content").html('<div class="p-4 text-center">Loading...</div>');

        // Show modal
        $('#modal-order-info').modal('show');

        // AJAX call to fetch view
        $.get(url, function(response) {
            $("#modal-order-info .modal-content").html(response);
        }).fail(function() {
            $("#modal-order-info .modal-content").html('<div class="p-4 text-danger text-center">Failed to load data!</div>');
        });
    }
</script>
@endsection

