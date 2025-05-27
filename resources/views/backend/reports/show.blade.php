
<div class="modal-header">
    <h5 class="modal-title">Order Details</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <!-- Yaha Order ki Details AJAX se Load Hogi -->
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Column Name</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Order ID</strong></td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Order Date</strong></td>
                        <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Billing name</strong></td>
                        <td>{{ $order->billing_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Contact Number</strong></td>
                        <td>{{ $order->billing_contact }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $order->billing_email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Billing Address</strong></td>
                        <td>{{ $order->billing_address }}, {{ $order->billing_city }}, 
                            {{ $order->billing_state }} - {{ $order->billing_zip }}, {{ $order->billing_country }}
                        </td>
                    </tr>
                    
                    @if(isset($order->shipping_address))
                    <tr>
                        <td><strong>Shipping Name</strong></td>
                        <td>{{ $order->shipping_name ?? $order->billing_name }}</td> 
                    </tr>
                    <tr>
                        <td><strong>Shipping Address</strong></td>
                        <td>{{ $order->shipping_address }}, {{ $order->shipping_city }}, 
                            {{ $order->shipping_state }} - {{ $order->shipping_zip }}, {{ $order->shipping_country }}
                        </td>
                    </tr>
                    @endif
                    
                    <tr>
                        <td><strong>Quantity</strong></td>
                        <td>{{ $order->orderItems->sum('quantity') }}</td> 
                    </tr> 
                    <tr>
                        <td><strong>Subtotal</strong></td>
                        <td>₹{{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Shipping Charges</strong></td>
                        <td>₹{{ number_format($order->shipping_cost ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Amount</strong></td>
                        <td>₹{{ number_format($order->total, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Order Status</strong></td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>




<div class="modal-header">
    <h5 class="modal-title">Report Details - Order #{{ $report->order_id }}</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <p><strong>Order ID:</strong> {{ $report->order_id }}</p>
    <p><strong>Customer Name:</strong> {{ $report->customer_name }}</p>
    <p><strong>Total Price:</strong> ₹{{ number_format($report->total_price, 2) }}</p>
    <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($report->order_date)->format('d M Y') }}</p>
    <p><strong>Order Status:</strong> {{ $report->order_status }}</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

