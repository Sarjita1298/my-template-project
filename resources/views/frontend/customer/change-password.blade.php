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
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li >
                <a href="{{ url('/contact') }}"><i class="fa fa-envelope"></i> CONTACT US</a>
            </li>
        </ol>

    </div>
</section>
<section class="bg-acc py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar (3 Columns) -->
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="widget widget-sidebar widget-list-link">
                        <ul class="wd-list-link">
                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                            <li><a href="{{ route('customer.dashboard') }}">My Order</a></li>
                            <li><a href="{{ route('customerprofile.index') }}">Profile Update</a></li>
                            <li><a href="{{ route('customerpassword.password') }}">Change Password</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content (9 Columns) -->
            <div class="col-md-9">
                <h2>Change Password</h2>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Password Change Form --}}
                <form method="POST" action="{{ route('customerpassword.update') }}">
                    @csrf

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" name="new_password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
