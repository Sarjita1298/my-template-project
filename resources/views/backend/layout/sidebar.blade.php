<style>
    .profile-img {
        width: 95px;
        height: 95px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        margin-left:10px;
    }

    .camera-icon {
        font-size: 12px;
        padding: 6px;
        background-color: #343a40;
        color: #fff;
        border-radius: 50%;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.4);
    }
    .sidebar .nav-link {
  color: #adb5bd;
  transition: 0.3s ease;
}

.sidebar .nav-link:hover {
  background-color: #e9ecef;
  color: #000;
}

.sidebar .nav-link.active {
  background-color: #0d6efd;
  color: #fff !important;
  font-weight: 600;
  border-radius: 0.375rem;
}

.sidebar .nav-link.active i {
  color: #fff !important;
}
.brand-logo {
    display: flex;
    align-items: center;
    justify-content: start;
    gap: 10px;
    padding: 10px 15px;
    position: relative;
    cursor: pointer;
}

.brand-logo img {
    border-radius: 50%;
    border: 2px solid #fff;
    width: 55px;
    height: 55px;
    object-fit: cover;
    display: block;
}

.brand-logo .camera-icon {
    position: absolute;
    bottom: 10px;
    left: 45px;
    background-color: #343a40;
    color: #fff;
    border-radius: 50%;
    padding: 5px;
    font-size: 12px;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
    transition: background-color 0.3s ease;
}

.brand-logo:hover .camera-icon {
    background-color: #0d6efd;
}

.logo-name-form {
    padding: 0 15px;
}

.logo-name-form input {
    font-size: 14px;
    padding: 6px 8px;
    width: 100%;
    margin-top: 5px;
    border-radius: 0.25rem;
    border: none;
}

.logo-name-form button {
    width: 100%;
    font-size: 13px;
    margin-top: 6px;
    padding: 5px 10px;
    border-radius: 0.25rem;
}


</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
{{-- <a href="{{ route('dashboard') }}" class="brand-link">
  <img src="{{ asset('backend/images/AdminLTELogo.png') }}" alt="" style="border-radius:50%"
 class="img-circle-2 border" width="60" height="60" >
  <span class="brand-text font-weight-light">AdminLTE 3</span>
</a> --}}

<div class="d-flex align-items-center p-2">
    {{-- Upload Logo Form --}}
    <form id="uploadLogoForm" action="{{ route('upload.logo') }}" method="POST" enctype="multipart/form-data" class="position-relative mr-2">
        @csrf
        <label for="logoInput" class="brand-logo m-0">
            <img src="{{ asset('backend/images/AdminLTELogo.png') }}?v={{ time() }}" alt="Logo" />
            <i class="fas fa-camera camera-icon"></i>
        </label>
        <input type="file" id="logoInput" name="logo" accept="image/*" style="display:none;" onchange="document.getElementById('uploadLogoForm').submit();">
    </form>

    <a href="{{ route('dashboard') }}" class="brand-link">
  <span class="brand-text font-weight-light fs-2">{{ $logo_name }}</span>
</a>

 {{-- <a href="{{ route('dashboard') }}" class="brand-link">
  <span class="brand-text font-weight-light">{{ config('app.logo_name') }}</span>             //  through .env file
</a> --}}

    {{-- Logo Name Update Form --}}
    {{-- <form id="updateLogoNameForm" action="{{ route('update.logoName') }}" method="POST" class="d-flex align-items-center">
        @csrf
        <input type="text" name="logo_name"  class="form-control form-control-sm" placeholder="Enter Logo Name" required style="max-width: 150px;">
        <button type="submit" class="btn btn-success btn-sm ml-2" title="Update Name">
            <i class="fas fa-check"></i>
        </button>
    </form> --}}
</div>

@php
    $admin = Auth::guard('admin')->user();
    $profileImage = $admin && $admin->profile_picture
        ? asset('storage/profile_pictures/' . $admin->profile_picture) . '?v=' . ($admin->updated_at->timestamp ?? time())
        : asset('default-avatar.png');
@endphp

<div class="mt-3 pb-3 mb-3 d-flex align-items-center">
    <div class="position-relative" style="width: 100px; height: 100px;">
        <img src="{{ $profileImage }}" class="profile-img" id="sidebarProfileImg">

        <form id="profilePictureForm" action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data" class="position-absolute" style="bottom: 5px; right: 5px;">
            @csrf
            <label for="profilePictureInput" class="m-0 p-0" style="cursor: pointer;">
                <i class="fas fa-camera camera-icon"></i>
            </label>
            <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*" onchange="document.getElementById('profilePictureForm').submit();" style="display: none;">
        </form>
    </div>

    <!-- Admin Name -->
   <div class="ml-3">
  <a href="{{ route('profile.show') }}" class="text-white font-weight-light d-block fs-2">
    {{ $admin->name ?? 'Admin' }}
  </a>
</div>


</div>



<!-- Sidebar -->
<div class="sidebar">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

    <li class="nav-item">
      <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Category</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-box"></i>
        <p>Products</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('blogs.index') }}" class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-check"></i>
        <p>Blogs</p>
      </a>
    </li>

  </ul>
</div>


  <!-- /.sidebar -->
</aside>