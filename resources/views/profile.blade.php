@extends('layouts.app')
@section('breadcrumb')
    <div class="page-title-box">
        <h4 class="page-title">Profile</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-secondary">
                Account Created: {{Auth::user()->created_at->diffForHumans()}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Change your name
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <form action="{{route('profile.namechange')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" >
                            @error('name')
                                <span class="text-danger d-block">{{$message}}</span>
                            @enderror
                            <button class="btn btn-success btn-sm mt-2">Change Name</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Change your photo
                </div>
                @if (session('success_photo'))
                        <div class="alert alert-success">
                            {{session('success_photo')}}
                        </div>
                @endif
                {{-- @if (session('another'))
                    <div class="alert alert-success">
                        {{session('another')}}
                    </div>
                @endif --}}
                <div class="row">
                    <div class="col-md-6 text-center">
                        {{-- {{Auth::user()->profile_photo}} --}}
                        {{-- {{asset('uploads/profile_photos').'/'.Auth::user()->profile_photo}} --}}
                        <img class="card-img-top" width="100px" src="{{asset('uploads/profile_users').'/'.Auth::user()->profile_photo}}" alt="User Image" >
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('profile.photochange')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" class="form-control" name="photo" accept=".png,.jpg" >
                            @error('photo')
                                <span class="text-danger d-block">{{$message}}</span>
                            @enderror
                            <button class="btn btn-success btn-sm mt-2">Change photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Change password
                </div>

                <div class="card-body">
                    @if (session('successPass'))
                        <div class="alert alert-success">
                            {{session('successPass')}}
                        </div>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger">
                            {{session('failed')}}
                        </div>
                    @endif
                    @if (session('notMatched'))
                        <div class="alert alert-danger">
                            {{session('notMatched')}}
                        </div>
                    @endif
                    @if (session('matchedWithOld'))
                        <div class="alert alert-danger">
                            {{session('matchedWithOld')}}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{route('profile.passwordchange')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="oldPass" value="{{old('oldPass')}}">
                            @error('oldPass')
                                <span class="text-danger d-block">{{$message}}</span>
                            @enderror
                            <label>New Password</label>
                            <input type="password" class="form-control" name="newPass" value="{{old('newPass')}}">
                            @error('newPass')
                                <span class="text-danger d-block">{{$message}}</span>
                            @enderror
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPass" value="{{old('confirmPass')}}">
                            @error('confirmPass')
                                <span class="text-danger d-block">{{$message}}</span>
                            @enderror
                            <button class="btn btn-success btn-sm mt-2">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
