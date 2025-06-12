@extends('frontend.master')


		<section class="no-padding sh-pricing">
				<div class="sub-header ">
					<span>WELCOME TO OUR WORLD</span>
					<h3>MY ACCOUNT</h3>
					<ol class="breadcrumb">
						<li>
							<a href="{{ route('home') }}"><i class="fa fa-home"></i> HOME</a>
						</li>
						<li >
							<a href="{{ route('accountpage') }}"><i class="fa fa-account-card"></i>MY ACCOUNT</a>
						</li>
					</ol>
 
				</div>
			</section>
            <section class="bg-acc">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<div class="tab-warp-acc desk-pdt-30">
							  <!-- Nav tabs -->
						 	 	<ul class="nav tab-style-1 tab-style-2 tab-acc" role="tablist">
								    <li role="presentation" class="active"><a href="#Login" aria-controls="Login" role="tab" data-toggle="tab">Login</a></li>
								    <li role="presentation"><a href="#Register" aria-controls="Register" role="tab" data-toggle="tab">Register</a></li>
								   
						 	 	</ul>
							  	<div class="tab-content tab-content-style-1 tab-content-style-2">
								  	<div role="tabpanel" class="tab-pane fade in active" id="Login">
								  		<div class="login-warp">
								  			<form class="form-contact-warp form-calc-ship cb-form">
												<input   class="form-control" value="" required="" title="" placeholder="Username" type="text">
												<input   class="form-control" value="" required="" title="" placeholder="Password" type="password">
												<button type="submit" class="btn-main-color btn-block"> Sign In</button>
											</form>
											<div class="footer-acc">
												<a href="#">-  I've forgotten my password </a>
											 	<div class="checkbox">
												    <label>
												      <input type="checkbox"> Remember Me
												    </label>
											  	</div>
											</div>
								  		</div>
								  	</div>
								  	<div role="tabpanel" class="tab-pane fade" id="Register">
								  		<div class="login-warp">
								  			<form class="form-contact-warp form-calc-ship cb-form">
												<input   class="form-control" value="" required="required" title="" placeholder="Username" type="text">
												<input   class="form-control" value="" required="required" title="" placeholder="Email" type="email">
												<input   class="form-control" value="" required="required" title="" placeholder="Password" type="password">
												<input   class="form-control" value="" required="required" title="" placeholder="ReType Password" type="password">
												<button type="submit" class="btn-main-color btn-block"> Sign Up</button>
											</form>
											<div class="footer-acc">
												<p>Sign Up With: </p>
												<ul class="widget-footer-social-1 footer-post-share social-hover-defaul">
													<li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
													<li><a class="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
													<li><a class="google" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
													<li><a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
												</ul>											 	
											</div>
								  		</div>	
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
