@extends('frontend.master')

@section('title', 'Shop')


<section class="no-padding sh-company-history">
	<div class="sub-header ">
		<span>SHOPPING WITH US</span>
		<h3>OUR PRODUCTS</h3>
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
			<div class="col-md-3">
				<div class="sideabar">
					<div class="widget widget-sidebar widget-search">
						<h4 class="title-widget-sidebar">
							Search Products
						</h4>
						<form class="form-inline cb-form widget-form">
								
							{{-- <input class="form-control" id="widgetsearch" placeholder="Type your keyword" type="text"> --}}
							<input type="text" id="widgetsearch" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">

							<button type="button" class="btn-search"><i class="fa fa-search"></i></button>

						</form>
					</div>

					<div class="widget widget-sidebar widget-list-link">
							<h4 class="title-widget-sidebar">Product Categories</h4>

							{{-- Search form --}}
							{{-- <form method="GET" action="{{ route('shop') }}">
								<input type="text" name="search" class="form-control form-control-sm mb-2" placeholder="Search categories..." value="{{ request('search') }}">
							</form> --}}

							{{-- Category list --}}
							<ul class="wd-list-link">
								@foreach($categories as $category)
									<li>
										<a href="{{ route('shop', array_merge(request()->query(), ['category_id' => $category->id])) }}"
										class="{{ request('category_id') == $category->id ? 'active' : '' }}">
											{{ $category->name }}
										</a>
									</li>
								@endforeach
							</ul>

						</div>

					<div class="widget widget-sidebar widget-top-rate-product">
						<h4 class="title-widget-sidebar">
							Top Rated Products
						</h4>
						<ul class="product_list_widget">
							<li>
								<a href="singleshop">
									<img src="frontend/images/Shop/s1.jpg" class="img-responsive wp-post-image" alt
									="Image">
								</a>
								<h3 class="product-name"><a href="singleshop">Book Name</a></h3>
								<div class="product-rate">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star disable"></i>
									<i class="fa fa-star disable"></i>
								</div>
								<span class="price">
									<span class="amount">£56.29</span> 
								</span>
								</li>
							<li>
								<a href="singleshop">
									<img src="frontend/images/Shop/s2.jpg" class="img-responsive wp-post-image" alt
									="Image">
								</a>
								<h3 class="product-name"><a href="singleshop">Book Name</a></h3>
								<div class="product-rate">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star disable"></i>
									<i class="fa fa-star disable"></i>
								</div>
								<span class="price">
									<span class="amount">£56.29</span> 
								</span>
							</li>
							<li>
								<a href="">
									<img src="frontend/images/Shop/s3.jpg" class="img-responsive wp-post-image" alt
									="Image">
								</a>
								<h3 class="product-name"><a href="">Book Name</a></h3>
								<div class="product-rate">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star disable"></i>
									<i class="fa fa-star disable"></i>
								</div>
								<span class="price">
									<span class="amount">£56.29</span> 
								</span>
							</li>
						</ul>
					</div>

					<div class="widget widget-sidebar widget-tag">
						<h4 class="title-widget-sidebar">
							Product Tags
						</h4>
						<ul class="wd-tags">
							<li><a href="#">Ansurance</a></li>
							<li><a href="#">Consulatants</a></li>
							<li><a href="#">Porfit</a></li>
							<li><a href="#">Management</a></li>
							<li><a href="#">Advisors</a></li>
							<li><a href="#">Management</a></li>
							<li><a href="#">Trust</a></li>
							<li><a href="#">Financial Business</a></li>
							
							<li><a href="#">Money</a></li>
							<li><a href="#">Loans</a></li>
							
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="shop-page-warp">
					<div class="row">
						<div class="col-md-12">
							<div class="group-title-btn">
								<div class="title-block">
									<h3>Product Category Name</h3>
									<span class="bottom-title"></span>
								</div>

								<form method="GET" action="{{ route('shop') }}" class="d-inline-block">
									{{-- Preserve other query params (like search, category_id) on sorting --}}
									<input type="hidden" name="search" value="{{ request('search') }}">
									<input type="hidden" name="category_id" value="{{ request('category_id') }}">
									
									<select name="sort" onchange="this.form.submit()" class="form-control w-auto d-inline-block custom-select orderby">
										<option value="">Sort By</option>
										<option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Popularity</option>
										<option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
										<option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Newest</option>
										<option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price: Low to High</option>
										<option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Price: High to Low</option>
									</select>
								</form>
							</div>

						</div>
						<div class="list-product">
							@foreach ($products as $product)
								<div class="col-md-4 col-sm-6">
									<div class="product-item">
										<figure>
											<a href="{{ route('productview', $product->id) }}">
												<img src="{{ asset('frontend/images/Shop/1.jpg' . $product->image) }}" class="img-responsive" alt="Image">
											</a>
										</figure>
										<div class="product-detail">
											<h3>
												<a href="{{ route('productview', $product->id) }}">{{ $product->name }} ></a>
											</h3>
											<span class="price">
												<span class="amount">{{ $product->price }}</span> 
											</span>
											<div class="product-rate">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i <= $product->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star disable"></i>
													@endif
												@endfor
											</div>
										</div>

										<div class="group-btn">
											<a href="{{ route('shop.product', $product->id) }}" class="ot-btn btn-main-color">
												<i class="fa fa-eye" aria-hidden="true"></i> Quick View
											</a>
											<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

										
										</div>
									</div>
								</div>
							@endforeach

						</div>
							@foreach ($products as $product)
								<div class="col-md-4 col-sm-6">
									<div class="product-item">
										<figure>
											<a href="{{ route('productview', $product->id) }}">
												<img src="{{ asset('frontend/images/Shop/2.jpg' . $product->image) }}" class="img-responsive" alt="Image">
											</a>
										</figure>
										<div class="product-detail">
											<h3>
												<a href="{{ route('productview', $product->id) }}">{{ $product->name }} ></a>
											</h3>
											<span class="price">
												<span class="amount">{{ $product->price }}</span> 
											</span>
											<div class="product-rate">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i <= $product->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star disable"></i>
													@endif
												@endfor
											</div>
										</div>

										<div class="group-btn">
											<a href="{{ route('shop.product', $product->id) }}" class="ot-btn btn-main-color">
												<i class="fa fa-eye" aria-hidden="true"></i> Quick View
											</a>
											<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

										</div>
									</div>
								</div>
							@endforeach
							@foreach ($products as $product)
								<div class="col-md-4 col-sm-6">
									<div class="product-item">
										<figure>
											<a href="{{ route('productview', $product->id) }}">
												<img src="{{ asset('frontend/images/Shop/3.jpg' . $product->image) }}" class="img-responsive" alt="Image">
											</a>
										</figure>
										<div class="product-detail">
											<h3>
												<a href="{{ route('productview', $product->id) }}">{{ $product->name }}></a>
											</h3>
											<span class="price">
												<span class="amount">{{ $product->price }}</span> 
											</span>
											<div class="product-rate">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i <= $product->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star disable"></i>
													@endif
												@endfor
											</div>
										</div>

										<div class="group-btn">
											<a href="{{ route('shop.product', $product->id) }}" class="ot-btn btn-main-color">
												<i class="fa fa-eye" aria-hidden="true"></i> Quick View
											</a>
											<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

										</div>
									</div>
								</div>
							@endforeach
							@foreach ($products as $product)
								<div class="col-md-4 col-sm-6">
									<div class="product-item">
										<figure>
											<a href="{{ route('productview', $product->id) }}">
												<img src="{{ asset('frontend/images/Shop/4.jpg' . $product->image) }}" class="img-responsive" alt="Image">
											</a>
										</figure>
										<div class="product-detail">
											<h3>
												<a href="{{ route('productview', $product->id) }}">{{ $product->name }} ></a>
											</h3>
											<span class="price">
												<span class="amount">{{ $product->price }}</span> 
											</span>
											<div class="product-rate">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i <= $product->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star disable"></i>
													@endif
												@endfor
											</div>
										</div>

										<div class="group-btn">
											<a href="{{ route('shop.product', $product->id) }}" class="ot-btn btn-main-color">
												<i class="fa fa-eye" aria-hidden="true"></i> Quick View
											</a>
											<button class="btn btn-primary ot-btn btn-sub-color add-to-cart-btn"
												data-id="{{ $product->id }}"
												data-name="{{ $product->name }}"
												data-price="{{ $product->price }}"
												data-image="{{ $product->image }}"
												data-rating="{{ $product->rating }}">
												Add to Cart
											</button>
										</div>
									</div>
								</div>
							@endforeach
							@foreach ($products as $product)
								<div class="col-md-4 col-sm-6">
									<div class="product-item">
										<figure>
											<a href="{{ route('productview', $product->id) }}">
												<img src="{{ asset('frontend/images/Shop/5.jpg' . $product->image) }}" class="img-responsive" alt="Image">
											</a>
										</figure>
										<div class="product-detail">
											<h3>
												<a href="{{ route('productview', $product->id) }}">{{ $product->name }} ></a>
											</h3>
											<span class="price">
												<span class="amount">{{ $product->price }}</span> 
											</span>
											<div class="product-rate">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i <= $product->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star disable"></i>
													@endif
												@endfor
											</div>
										</div>

										<div class="group-btn">
											<a href="{{ route('shop.product', $product->id) }}" class="ot-btn btn-main-color">
												<i class="fa fa-eye" aria-hidden="true"></i> Quick View
											</a>
											<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>


										</div>
									</div>
								</div>
							@endforeach
							@foreach ($products as $product)
								<div class="col-md-4 col-sm-6">
									<div class="product-item">
										<figure>
											<a href="{{ route('productview', $product->id) }}">
												<img src="{{ asset('frontend/images/Shop/6.jpg' . $product->image) }}" class="img-responsive" alt="Image">
											</a>
										</figure>
										<div class="product-detail">
											<h3>
												<a href="{{ route('productview', $product->id) }}">{{ $product->name }} ></a>
											</h3>
											<span class="price">
												<span class="amount">{{ $product->price }}</span> 
											</span>
											<div class="product-rate">
												@for ($i = 1; $i <= 5; $i++)
													@if ($i <= $product->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star disable"></i>
													@endif
												@endfor
											</div>
										</div>

										<div class="group-btn">
											<a href="{{ route('shop.product', $product->id) }}" class="ot-btn btn-main-color">
												<i class="fa fa-eye" aria-hidden="true"></i> Quick View
											</a>
											<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="hidden" name="quantity" value="1">
    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

										</div>
									</div>
								</div>
							@endforeach
						
						</div>
						<div class="col-md-12">
						<ul class="pagination">
							<li><a href="#">PREVIOUS</a></li>
							<li><a href="#">NEXT</a></li>
							<li><a href="#">1</a></li>
							<li class="active"><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
						</ul>
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



@section('script')

<script>
	$(document).on('click', '.add-to-cart-btn', function (e) {
		e.preventDefault();

		let btn = $(this);

		$.ajax({
			url: '{{ route("cart.add") }}', // ✅ Ensure this route exists and points to your addToCart method
			method: 'POST',
			data: {
				_token: '{{ csrf_token() }}',
				product_id: btn.data('id'),
				name: btn.data('name'),
				price: btn.data('price'),
				image: btn.data('image'),
				rating: btn.data('rating')
			},
			success: function (response) {
				if (response.status) {
					alert(response.message);
					$('#cart-count').text(response.cartCount); // ✅ Update the cart count badge
				} else {
					alert('Something went wrong.');
				}
			},
			error: function (xhr) {
				console.error(xhr.responseText);
				alert('Error adding to cart.');
			}
		});
	});

	document.addEventListener('DOMContentLoaded', function () {
		// ================= Add to Cart =================
		const buttons = document.querySelectorAll('.add-to-cart-btn');

		buttons.forEach(button => {
			button.addEventListener('click', function (e) {
				e.preventDefault();

				const product = {
					id: this.dataset.id,
					name: this.dataset.name,
					price: this.dataset.price,
					image: this.dataset.image,
					quantity: 1
				};

				let cart = JSON.parse(localStorage.getItem('cart')) || [];
				const index = cart.findIndex(item => item.id === product.id);

				if (index !== -1) {
					cart[index].quantity += 1;
				} else {
					cart.push(product);
				}

				localStorage.setItem('cart', JSON.stringify(cart));
				alert(product.name + ' added to cart!');

				// Optionally refresh cart display after adding
				displayCartItems();
			});
		});

		// ================= Display Cart =================
		function displayCartItems() {
			const cart = JSON.parse(localStorage.getItem('cart')) || [];
			const cartItemsContainer = document.getElementById('cart-items');

			if (!cartItemsContainer) return; // Prevent error if cart list not present

			cartItemsContainer.innerHTML = '';

			if (cart.length === 0) {
				cartItemsContainer.innerHTML = '<li>Your cart is empty.</li>';
			} else {
				cart.forEach(item => {
					const li = document.createElement('li');
					li.innerHTML = `
						<img src="/frontend/images/Shop/${item.image}" width="50" alt="${item.name}">
						${item.name} - £${item.price} x ${item.quantity}
					`;
					cartItemsContainer.appendChild(li);
				});
			}
		}

		// Call on page load
		displayCartItems();
	});
</script>


@endsection






