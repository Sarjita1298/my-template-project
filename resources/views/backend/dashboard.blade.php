@extends('backend.master')

@section('title', 'Dashboard')

@section("content")
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>    
            </div>
            
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>  
                    <li class="breadcrumb-item"><a href="{{ route('profile.show') }}">Profile</a></li>
 
                </ol> 
            </div>
        </div> 
        @include('backend.layout.alert')
    </div>
</section>

<section class="content">
    <!-- Content goes here -->
</section>
@endsection

@section("javascript")
<script>
    window.onpageshow = function(event) { 
        if (event.persisted) {
            window.location.reload();
        }
    };
    </script>
    <script>
        history.pushState(null,null,location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
@endsection
