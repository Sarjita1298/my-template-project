@extends('frontend.master')
@section('title', 'Your Cart')

@php
    // Override totals if passed from session flash
    if(session()->has('subtotal')) {
        $subtotal = session('subtotal');
        $shipping = session('shipping');
        $total = session('total');
    }
@endphp

<section class="no-padding sh-company-history">
    <div class="sub-header ">
        <span>SHOPPING WITH US</span>
        <h3>SHOP CART</h3>
         <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li >
                <a href="{{ route('shop') }}"><i class="fa fa-shopping-cart"></i> SHOP</a>
            </li>
        </ol>
    </div>
</section>

<div class="container py-4">

    {{-- Success message here --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3>Your Shopping Cart</h3>
    
        @if(isset($cartItems) && count($cartItems))
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $id => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
<td class="product-price">{{ number_format(old('product_price', $product->product_price), 2) }}</td>
                            <td>₹{{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                <p><strong>Subtotal:</strong> ₹{{ $subtotal }}</p>
                <p><strong>Shipping:</strong> ₹{{ $shipping }}</p>
                <h4><strong>Total:</strong> ₹{{ $total }}</h4>
            </div>
        @else
            <p>No items in cart.</p>
        @endif

    <hr>

    <h4>Shipping Information</h4>
    <form id="shipping-form form-contact-warp form-calc-ship cb-form" method="POST" action="{{ route('shipping.update') }}">
        @csrf
        <div class="form-group mb-3">
            <label>Select State</label>
            <select name="state" id="state" class="form-control">
                <option value="">Select State</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Select District</label>
            <select name="district" id="district" class="form-control">
                <option value="">Select District</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Postal Code</label>
            <input type="text" name="pincode" id="pincode" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update Total</button>
    </form>
</div>

@section('scripts')
<script>
    $('#state').on('change', function () {
        let stateId = $(this).val();
        if (stateId) {
            $.get("{{ route('get.districts') }}", {state_id: stateId}, function (data) {
                let options = '<option value="">Select District</option>';
                $.each(data, function (i, district) {
                    options += `<option value="${district.id}">${district.name}</option>`;
                });
                $('#district').html(options);
                $('#pincode').val('');
            });
        }
    });

    $('#district').on('change', function () {
        let districtId = $(this).val();
        if (districtId) {
            $.get("{{ route('get.pincode') }}", {district_id: districtId}, function (data) {
                $('#pincode').val(data ? data.code : '');
            });
        }
    });
</script>
@endsection
