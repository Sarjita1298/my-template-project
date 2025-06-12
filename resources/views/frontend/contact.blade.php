@extends('frontend.master')

@section('content')

<section class="sh-contact">
    <div class="sub-header" style="
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
        url('{{ asset('frontend/images/bg-content/sh-contact.jpg') }}') center center / cover no-repeat;
    ">
        <span>CONNECT WITH US</span>
        <h3>GET IN TOUCH</h3>
        <ol class="breadcrumb">
           <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li >
                <a href="{{ route('contact') }}"><i class="fa fa-envelope"></i> CONTACT US</a>
            </li>
        </ol>
        </ol>

    </div>
</section>



<!-- Contact Info Boxes -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="iconbox-inline">
					<span class="icon icon-location2"></span>
					<h4>Head Office</h4>
					<p class="hidden-text-fix">123, Business Street, City Name</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="iconbox-inline">
					<span class="icon icon-phone"></span>
					<h4>Phone Numbers</h4>
					<p class="hidden-text-fix">+91 12345 67890</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="iconbox-inline">
					<span class="icon icon-envelop"></span>
					<h4>E-mail Address</h4>
					<p class="hidden-text-fix">contact@example.com</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Google Map (Optional: you can remove or update) -->
<div id="map-canvas" class="map-warp" style="height: 360px;"></div>

<!-- Contact Form -->
<section>
	<div class="container">	
		<div class="row">
			<div class="col-md-12">
				<div class="title-block title-contact">
					<h3>Send a Message</h3>
					<span class="bottom-title"></span>
				</div>
			</div>
			<div class="form-contact-warp">
				<form name="contactform" method="post" action={{ route('contact.submit') }}>
					@csrf
					<div class="col-md-4">
						<input type="text" class="form-control" name="name" placeholder="Full Name" required>
					</div>
					<div class="col-md-4">
						<input type="email" class="form-control" name="email" placeholder="Email Address" required>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" name="subject" placeholder="Subject">
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<textarea name="message" class="form-control" rows="5" placeholder="Comment" required></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<button type="submit" class="btn-main-color">
							<i class="fa fa-paper-plane" aria-hidden="true"></i> Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Newsletter Subscription -->
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
{{-- 
@endsection --}}


{{-- @section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const header = document.querySelector("header.site-header");
    const subHeader = document.querySelector(".sub-header");

    if (header && subHeader) {
        const headerHeight = header.offsetHeight;
        subHeader.style.marginTop = headerHeight + "px";
    }
});

</script>
    
@endsection --}}