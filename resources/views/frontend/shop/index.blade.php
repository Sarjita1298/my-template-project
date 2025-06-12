@extends('frontend.master')



@section('title', 'Home Page')


<section class="sh-contact">
    <div class="sub-header" style="
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
        url('{{ asset('frontend/images/bg-content/sh-contact.jpg') }}') center center / cover no-repeat;
    ">
        <span>CONNECT WITH US</span>
        <h3>GET IN TOUCH</h3>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> HOME</a>
            </li>
            <li >
                <a href="{{ route('contact') }}"><i class="fa fa-envelope"></i> CONTACT US</a>
            </li>
        </ol>

    </div>
</section>

<section class="bg-acc" style="background: url('{{ asset('frontend/images/bg-content/bg-acc.jpg') }}') no-repeat; background-size: cover; background-position: center;">
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
                {{-- Error messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Success message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Profile</h3>
                    </div>
                    <form action="{{ route('customerprofile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" value="{{ old('username', $user->name ?? '') }}" id="username" name="username" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" id="exampleInputEmail1" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                                    <label class="custom-file-label" for="profile_picture">Choose file</label>
                                </div>
                                @if (!empty($user->profile_picture))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


{{-- <section class="content">
                    <div class="container-fluid"> --}}

                        {{-- Error messages --}}
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                        {{-- Success message --}}
                        {{-- @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">User Profile</h3>
                                    </div>
                                    <form action="{{ route('customerprofile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" value="{{ old('username', $user->name ?? '') }}" id="username" name="username" placeholder="Enter username">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" id="exampleInputEmail1" name="email" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="profile_picture">Profile Picture</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                                                    <label class="custom-file-label" for="profile_picture">Choose file</label>
                                                </div>
                                                @if (!empty($user->profile_picture))
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" width="100">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Save Change</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}

                    {{-- </div>
    </section> --}}

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Bootstrap custom file input label update --}}
<script>
    $(document).ready(function () {
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
@endsection
