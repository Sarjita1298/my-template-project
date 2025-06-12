@php
    use Illuminate\Support\Facades\Auth;
    $admin = Auth::guard('admin')->user();
@endphp

@extends('backend.master')

@section('title', 'Profile')

@section('content')

<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6 text-right">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('profile.show') }}">Profile</a></li>
                </ol>
            </div>
        </div>
        @include('backend.layout.alert')
    </div>
</section>

<section class="content">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                {{-- <form id="uploadForm" action="{{ route('upload.logo') }}" method="POST" enctype="multipart/form-data" style="display:inline;">
                        @csrf
                        <label for="logoInput" style="cursor:pointer;">
                            <img src="{{ asset('backend/images/AdminLTELogo.png') }}" alt="" style="border-radius:50%;" class="img-circle-2 border" width="60" height="60">
                            <i class="fas fa-camera" style="position: absolute; top: 45px; left: 45px; color: black;"></i>
                        </label>
                        <input type="file" id="logoInput" name="logo" accept="image/*" style="display:none;" onchange="document.getElementById('uploadForm').submit();">
                    </form> --}}

                    {{-- <form action="{{ route('profile.show') }}" method="POST" class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="text" name="logo_name" value="{{ $logo_name }}" class="form-control form-control-sm" placeholder="Enter Logo Name" required style="max-width: 200px;">
                        <button type="submit" class="btn btn-success btn-sm" title="Update Logo Name">
                            <i class="fas fa-check"></i> Update
                        </button>
                    </form> --}}



                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profile</h3>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')            
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                            </div>
                                        <!-- Inside the Profile form -->
                            {{-- <div class="form-group">
                                <label>Profile Image</label>
                                <input type="file" name="profile_image" class="form-control-file">
                                @if($admin->profile_image)
                                    <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}" class="mt-2" width="80" height="80" style="object-fit:cover; border-radius:50%;">
                                @endif
                            </div> --}}
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                        </div>
                        
                    </form>
                   <form id="updateLogoNameForm" action="{{ route('update.logoName') }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="text" name="logo_name" id="logo_name" value="{{ old('logo_name', $logo_name ?? 'AdminLTE 3') }}" class="form-control" placeholder="Enter Logo Name" required>
                        <button type="submit" class="btn btn-primary btn-sm ml-2" title="Update Name">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>

                    <div id="updateMessage" style="margin-left:10px;"></div>
                </div>
                    
            </div>

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change Password</h3>
                    </div>
                    <form action="{{ route('profile.change_password') }}" method="POST" onsubmit="return validatePassword()">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group position-relative">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" id="current-password" required>
                                <span class="position-absolute toggle-password" data-target="#current-password" style="top: 38px; right: 10px; cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <div class="form-group position-relative">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" id="new-password" required>
                                <span class="position-absolute toggle-password" data-target="#new-password" style="top: 38px; right: 10px; cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <div class="form-group position-relative">
                                <label>Confirm Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" id="confirm-password" required>
                                <span class="position-absolute toggle-password" data-target="#confirm-password" style="top: 38px; right: 10px; cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group position-relative">
                            <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    function validatePassword() {
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("confirm-password").value;
        const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;

        if (!pattern.test(newPassword)) {
            alert("Password must be at least 6 characters and include uppercase, lowercase, and a number.");
            return false;
        }

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        return true;
    }
</script>
<script>
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const input = document.querySelector(this.dataset.target);
            if (!input) return;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    }); 
</script>
<script>
    document.querySelector('#profilePictureInput').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                
                document.getElementById('profilePreview').src = event.target.result;

                const sidebarImg = document.getElementById('sidebarProfileImg');
                if (sidebarImg) {
                    sidebarImg.src = event.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#updateLogoNameForm').on('submit', function(e){
        e.preventDefault(); // form submit रोको, AJAX से भेजेंगे

        let logoName = $('#logo_name').val();
        let token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ route('update.logoName') }}",
            type: "POST",
            data: {
                _token: token,
                logo_name: logoName,
            },
            success: function(response) {
                if(response.success){
                    $('#updateMessage').html('<span style="color:green;">'+response.message+'</span>');
                } else {
                    $('#updateMessage').html('<span style="color:red;">Something went wrong.</span>');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                $.each(errors, function(key, value){
                    errorMsg += value[0] + '<br>';
                });
                $('#updateMessage').html('<span style="color:red;">'+errorMsg+'</span>');
            }
        });
    });
</script>



@endsection
