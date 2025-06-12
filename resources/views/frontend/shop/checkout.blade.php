@extends('frontend.master')

<!-- Sub Header -->
<section class="no-padding sh-company-history">
    <div class="sub-header">
        <span>SHOPPING WITH US</span>
        <h3>SHOP CHECKOUT</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li>
                <a href="{{ route('shop') }}"><i class="fa fa-shopping-cart"></i> SHOP</a>
            </li>
        </ol>
    </div>
</section>

<section>
    <div class="container">
        <form action="{{ route('checkout.submit') }}" method="POST" class="row form-contact-warp form-calc-ship cb-form">
            @csrf

            <!-- Payment Options -->
            <div class="col-md-4 col-sm-12">
                <div class="title-block title-contact">
                    <h3>Payment Options</h3>
                    <span class="bottom-title"></span>
                </div>

                    <table class="table table-bordered table-striped table-payment">
                        <tbody>
                            <tr>
                                <th scope="row">Cart Subtotals</th>
                                <td>₹{{ number_format($cartSubtotal ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Shipping & Handling</th>
                                <td>₹{{ number_format($shippingCharge ?? 0, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>Order Totals</strong></td>
                                <td>₹{{ number_format($orderTotal ?? 0, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>


                <div class="title-block title-contact">
                    <h3>Select Payment Method</h3>
                    <span class="bottom-title"></span>
                </div>

                <div>
                    <select name="payment_method" class="cb form-control" required>
                        <option value="">Select Payment Method</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="merchant_card">Merchant Credit Card</option>
                        <option value="pickup">Payment Upon Pickup</option>
                    </select>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="col-md-4 col-sm-6">
                <div class="title-block title-contact">
                    <h3>Shipping Address</h3>
                    <span class="bottom-title"></span>
                </div>

                <input class="form-control mb-2" name="shipping_name" id="shipping-name" required placeholder="Full Name" type="text">
                <input class="form-control mb-2" name="shipping_address" id="shipping-address" required placeholder="Address" type="text">
                <input class="form-control mb-2" name="shipping_email" id="shipping-email" required placeholder="Email" type="email">
                <input class="form-control mb-2" name="shipping_contact" id="shipping-contact" required placeholder="Contact" type="tel">
                <input class="form-control mb-2" name="shipping_city" id="shipping-city" required placeholder="City" type="text">
                <input class="form-control mb-2" name="shipping_state" id="shipping-state" required placeholder="State" type="text">
                <input class="form-control mb-2" name="shipping_zip" id="shipping-zip" required placeholder="Zip Code" type="text">
                <input class="form-control mb-2" name="shipping_country" id="shipping-country" required placeholder="Country" type="text">

                <div class="mt-2">
                    <input type="checkbox" id="same-address">
                    <label for="same-address">Billing address same as Shipping</label>
                </div>
            </div>

            <!-- Billing Address -->
            <div class="col-md-4 col-sm-6">
                <div class="title-block title-contact">
                    <h3>Billing Address</h3>
                    <span class="bottom-title"></span>
                </div>

                <input class="form-control mb-2" name="billing_name" id="billing-name" required placeholder="Full Name" type="text">
                <input class="form-control mb-2" name="billing_address" id="billing-address" required placeholder="Address" type="text">
                <input class="form-control mb-2" name="billing_email" id="billing-email" required placeholder="Email" type="email">
                <input class="form-control mb-2" name="billing_contact" id="billing-contact" required placeholder="Contact" type="tel">
                <input class="form-control mb-2" name="billing_city" id="billing-city" required placeholder="City" type="text">
                <input class="form-control mb-2" name="billing_state" id="billing-state" required placeholder="State" type="text">
                <input class="form-control mb-2" name="billing_zip" id="billing-zip" required placeholder="Zip Code" type="text">
                <input class="form-control mb-2" name="billing_country" id="billing-country" required placeholder="Country" type="text">

                <!-- Place Order Button Below Billing -->
                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-primary btn-md">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</section>


<!-- Related Products -->
<section class="bg-light-grey">
    <div class="container">
        <div class="title-block title-contact">
            <h3>Related Products</h3>
            <span class="bottom-title"></span>
        </div>

        <div class="owl-relate-product row">
            @foreach ($products as $product)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="product-item">
                        <figure>
                            <a href="{{ route('product.view', $product->id) }}">
                                <img src="{{ asset('storage/products/' . $product->image) }}" class="img-responsive" alt="{{ $product->name }}">
                            </a>
                        </figure>
                        <div class="product-detail">
                            <h4><a href="{{ route('product.view', $product->id) }}">{{ $product->name }}</a></h4>
                            <span class="price">
                                <span class="amount">£{{ number_format($product->price, 2) }}</span>
                            </span>
                            @php $rating = round($product->rating); @endphp
                            <div class="product-rate">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star{{ $i <= $rating ? '' : ' disable' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="group-btn">
                            <a href="{{ route('product.view', $product->id) }}" class="ot-btn btn-main-color">
                                <i class="fa fa-eye"></i> Quick View
                            </a>
                            <a href="{{ route('cart.add', $product->id) }}" class="ot-btn btn-sub-color">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="bg-subcr-1">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="subcribe-warp">
          <p class="sub-text-subcri">Newsletter to receive</p>
          <form class="form-inline form-subcri" action="/subscribe" method="POST">
            @csrf
            <div class="form-group">
              <label for="emailInput"><small>our <span>latest company</span> updates</small></label>
              <input type="email" class="form-control" id="emailInput" name="email" placeholder="Your E-mail Address" required />
            </div>
            <button type="submit" class="btn-subcrib">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </button>
          </form>
          @if(session('success'))
            <div class="alert alert-success mt-2">
              {{ session('success') }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>







@section('scripts')

@section('scripts')
<script>
    document.getElementById('same-address').addEventListener('change', function () {
        const fields = ['name', 'address', 'email', 'contact', 'city', 'state', 'zip', 'country'];
        fields.forEach(field => {
            const ship = document.getElementById('shipping-' + field);
            const bill = document.getElementById('billing-' + field);
            if (this.checked) {
                bill.value = ship.value;
            } else {
                bill.value = '';
            }
        });
    });
</script>
@endsection


@endsection