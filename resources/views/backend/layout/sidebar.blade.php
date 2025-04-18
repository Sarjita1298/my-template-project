<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{ route('dashboard') }}" class="brand-link">
  <img src="{{ asset('backend/images/AdminLTELogo.png') }}" alt="" style="border-radius:50%"
 class="img-circle-2 border" width="60" height="60" >
  <span class="brand-text font-weight-light">AdminLTE 3</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->
@php
    $admin = Auth::guard('admin')->user();
    $profileImage = $admin && $admin->profile_picture
        ? asset('storage/profile_pictures/' . $admin->profile_picture) . '?v=' . ($admin->updated_at->timestamp ?? time())
        : asset('default-avatar.png');
@endphp
<div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
    {{-- <div class="image">  --}}
      <a href="{{ route('profile.show') }}" class="brand-link">
        <img id="sidebarProfileImg" src="{{ $profileImage }}" class="img-circle-2 border" >
    {{-- </div> --}}
    {{-- <div class="info"> --}}
        <a href="{{ route('profile.show') }}" class="d-block">
            {{ $admin->name ?? 'Admin' }}
        </a>
    {{-- </div>  --}}
</div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="dashboard" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
         
        </li>
       </ul>
    </nav>
    <!-- /.sidebar-menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ route('categories.index') }}" class="nav-link active">
            <i class="nav-icon fas fa-list"></i>
            <p>
             Category
            </p>
          </a>
        </li>
       </ul>
    </nav>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ route('products.index') }}" class="nav-link active">
            <i class="nav-icon fas fa-box"></i>
            <p>
             Products
            </p>
          </a>
        </li>
       </ul>
    </nav>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{ route('blogs.index') }}" class="nav-link active">
            <i class="nav-icon fas fa-check"></i>
            <p>
            Blogs
            </p>
          </a>
        </li>
       </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>