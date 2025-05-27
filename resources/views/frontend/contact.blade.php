@extends('frontend.master')

@section('title','Contact Page')

@section('content')

<section class="no-padding sh-pricing">
    <div class="sub-header">
        <span>WELCOME TO OUR WORLD</span>
        <h3>MY ACCOUNT</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li class="active">MY ACCOUNT</li>
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
                        <li role="presentation" class="active">
                            <a href="#Login" aria-controls="Login" role="tab" data-toggle="tab">Login</a>
                        </li>
                        <li role="presentation">
                            <a href="#Register" aria-controls="Register" role="tab" data-toggle="tab">Register</a>
                        </li>
                    </ul>

                    <div class="tab-content tab-content-style-1 tab-content-style-2">
                        <!-- Login Form -->
                        <div role="tabpanel" class="tab-pane fade in active" id="Login">
                            <div class="login-warp">
                                <form action="{{ route('login') }}" method="POST" class="form-contact-warp form-calc-ship cb-form">
                                    @csrf
                                    <input name="username" class="form-control" required placeholder="Username" type="text">
                                    <input name="password" class="form-control" required placeholder="Password" type="password">
                                    <button type="submit" class="btn-main-color btn-block">Sign In</button>
                                </form>
                                <div class="footer-acc">
                                    <a href="{{ route('password.request') }}">- I've forgotten my password</a>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Register Form -->
                        <div role="tabpanel" class="tab-pane fade" id="Register">
                            <div class="login-warp">
                                <form action="{{ route('register') }}" method="POST" class="form-contact-warp form-calc-ship cb-form">
                                    @csrf
                                    <input name="username" class="form-control" required placeholder="Username" type="text">
                                    <input name="email" class="form-control" required placeholder="Email" type="email">
                                    <input name="password" class="form-control" required placeholder="Password" type="password">
                                    <input name="password_confirmation" class="form-control" required placeholder="ReType Password" type="password">
                                    <button type="submit" class="btn-main-color btn-block">Sign Up</button>
                                </form>
                                <div class="footer-acc">
                                    <p>Sign Up With:</p>
                                    <ul class="widget-footer-social-1 footer-post-share social-hover-defaul">
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Register -->
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
                    <p class="sub-text-subcri">Newsletter for receive</p>
                    <form class="form-inline form-subcri" method="POST" action="#">
                        @csrf
                        <div class="form-group">
                            <label for="newsletterEmail">
                                <small>our <span>latest company</span> updates</small>
                            </label>
                            <input type="email" name="email" class="form-control" id="newsletterEmail" placeholder="Your E-mail Address" required>
                        </div>
                        <button type="submit" class="btn-subcrib">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
