@extends('backend.master')

@section('content')
<div class="container">
    <h3>My Profile</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <div class="text-center">
            <img src="{{ $admin->profile_picture ? asset('storage/profile_pictures/' . $admin->profile_picture) : asset('default-avatar.png') }}"
                 class="rounded-circle" width="120" height="120" style="object-fit: cover;">
        </div>

        <h5 class="text-center mt-2">{{ $admin->name }}</h5>

        <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="profile_picture">Change Profile Picture</label>
                <input type="file" class="form-control" name="profile_picture" accept="image/*" required>
            </div>
            <button class="btn btn-primary">Update Picture</button>
        </form>
    </div>
</div>
@endsection
