
@extends('backend.master')

@section('title')
Report
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
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Report File</h3>
           
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th> Order ID</th>
                        <th> Customer Name</th>
                        {{-- <th> Quantity</th> --}}
                        <th> Total Price</th>
                        <th> Order Date</th>
                        <th> Order Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>{{ $loop->iteration  }}</td> 
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->customer_name }}</td>
                            {{-- <td>{{ $order->orderItems->sum('quantity') }}</td>  <!-- FIXED --> --}}
                            <td>₹{{ number_format($report->total, 2) }}</td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                            <td>{{ $report->order_status }}</td>
                            <td class="text-center">
                                <a href="{{ route('reports.index', $report->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-truck"></i>
                                </a>
                                
                                 <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="getOrderInfo('{{ $report->id }}');">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                 
                                <a href="{{ route('reports.index', $report->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                
                                <form action="{{ route('reports.index', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                                @if ($report->return_status == 'requested')
                                <form action="{{ route('reports.index', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                            
                                <form action="{{ route('reports.index', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            @endif
                            
                            @if ($report->return_status == 'approved')
                                <form action="{{ route('reports.index', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-box"></i> Mark as Picked Up
                                    </button>
                                </form>
                            @endif
                            
                            @if ($report->return_status == 'picked')
                                <form action="{{ route('reports.index', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-undo"></i> Process Refund
                                    </button>
                                </form>
                            @endif
                            
                            @if ($report->return_status == 'refunded')
                                <form action="{{ route('reports.index', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check-double"></i> Complete Return
                                    </button>
                                </form>
                            @endif
                            
                                
                             </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</section>


<div class="modal fade" id="modal-order-info" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- <div class="modal fade" id="modal-order-info" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Yaha Order ki Details AJAX se Load Hogi -->
                <div id="order-details-content">
                    <p>Loading...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}




@endsection()

@section('javaScript')
<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        $('.select2').select2();
    });
    
    const getOrderInfo = (orderId) => {
    let url = "{{ route('reports.info', ':id') }}".replace(':id', orderId);

    $("#modal-order-info .modal-dialog .modal-content").load(url, function(response, status) {
        if (status === "success") {
            $('#modal-order-info').modal('show');
        } else {
            alert("Error loading order details!");
        }
    });
};
const getOrderInfo = (orderId) => {
    let url = "{{ route('reports.info', ':id') }}".replace(':id', orderId);

    $("#order-details-content").html("<p>Loading...</p>"); // Loading Indicator

    $("#modal-order-info").modal("show"); // Modal Show Karein

    $.get(url, function(response) {
        $("#order-details-content").html(response); // Response Load Karna
    }).fail(function() {
        $("#order-details-content").html("<p class='text-danger'>Error loading order details!</p>");
    });
};




</script>
@endsection()   
