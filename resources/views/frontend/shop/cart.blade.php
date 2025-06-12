@extends('frontend.master')


	
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
			<!-- /Sub HEader -->
			
<section>
    <div class="container">
        <div class="row">
            <div class="shop-cart-warp">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-reset table-striped table-cart">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cart as $id => $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('shop') }}">
                                                <img src="{{ asset('uploads/products/' . $item['image']) }}" width="80" alt="{{ $item['name'] }}">
                                            </a>
                                        </td>
										<td>{{ $product->product_name }}</td>
										<td class="product-price">{{ number_format($product->product_price, 2) }}</td>

                                        <td class="product-quantity">
                                            <div class="quantity">
                                                <input class="minus" value="-" type="button">
                                                <input class="qty" name="quantity" value="{{ $item['quantity'] }}" type="text">
                                                <input class="plus" value="+" type="button">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </td>
                                        <td class="product-remove">
                                            <a href="{{ route('cart.remove', $id) }}"><i class="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Your cart is empty.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <form class="form-inline cb-form form-coupon pull-left">
                        <div class="form-group">
                            <input placeholder="Coupon Code" id="CouponCode" class="form-control form-coupon-input" type="text">
                            <a href="#" class="ot-btn btn-main-color"><span>Apply Coupon</span></a>
                        </div>
                    </form>

                    <div class="group-btn pull-right">
                        <a href="{{ route('cart.update') }}" class="ot-btn btn-sub-color">Update</a>
                        <a href="{{ route('checkout') }}" class="ot-btn btn-main-color">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

			<!-- /Table Cart -->

<section class="bg-light-grey">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="title-block title-contact">
					<h3>Cart Totals</h3>
					<span class="bottom-title"></span>
				</div>
				<div class="table-responsive table-cart-total">
					<table class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cart as $productId => $item)
								<tr>
									<td>{{ $item['product_name'] }}</td>
									<td class="product-price">₹{{ number_format($item['price'], 2) }}</td>
									<td class="product-quantity">
										<div class="quantity">
											<input class="minus" value="-" type="button">
											<input class="qty" name="quantity[{{ $productId }}]" value="{{ $item['quantity'] }}" type="text">
											<input class="plus" value="+" type="button">
										</div>
									</td>
									<td class="product-subtotal">
										₹{{ number_format($item['price'] * $item['quantity'], 2) }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="title-block title-contact">
					<h3>Calculate Shipping</h3>
					<span class="bottom-title"></span>
				</div>
				<form class="form-contact-warp form-calc-ship cb-form">
					<div>
						<select class="cb form-control">
							<option value="">Select Your Country</option>
							<option value="AX">Åland Islands</option>
							<option value="AF">Afghanistan</option>
							<option value="AL">Albania</option>
							<option value="ZW">Zimbabwe</option>
						</select>
					</div>
					<div>
						<input class="form-control" required placeholder="State" type="text">
					</div>
					<div>
						<input class="form-control" required placeholder="Postal Code" type="text">
					</div>
					<div>
						<button type="submit" class="btn-main-color btn-block">Update Total</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</section>


<!-- /Caculate -->

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title-block title-contact">
					<h3>Related Products</h3>
					<span class="bottom-title"></span>
				</div>
			</div>
			<div class="relate-product-owl-warp">
				<div id="relate-product" class="owl-relate-product">
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="frontend/images/Shop/1.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="frontend/images/Shop/2.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="sho">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="frontend/images/Shop/3.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="shop">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="frontend/images/Shop/4.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="shop">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="frontend/images/Shop/5.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="shop">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="imagefrontend/s/Shop/6.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="shop">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
					<div class="product-item">
						<figure >
							<a href="shop">
								<img src="frontend/images/Shop/7.jpg" class="img-responsive" alt="Image">
							</a>
						</figure>
						<div class="product-detail">
							<h3><a href="shop">Book Name</a></h3>
							<span class="price">
								<span class="amount">£56.29</span> 
							</span>
							<div class="product-rate">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star disable"></i>
								<i class="fa fa-star disable"></i>
							</div>
						
						</div>
						<div class="group-btn">
							<a href="shop" class="ot-btn btn-main-color">
							<i class="fa fa-eye" aria-hidden="true"></i> Quick View
							</a>
							<a href="#" class="ot-btn btn-sub-color">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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

