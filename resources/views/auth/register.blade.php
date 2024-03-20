@extends('layouts.app_auth')
@section('auth_form')
<div class="card-box p-5">
    <h2 class="text-uppercase text-center pb-4">
        <a href="index.html" class="text-success">
            <span><img src="{{asset('dashboard')}}/assets/images/logo.png" alt="" height="26"></span>
        </a>
    </h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
    <form  method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="username">Full Name<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="username" name="name"  value="{{ old('name') }}" placeholder="Michael Zenaty">
                @error('name')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="phoneNumber">Phone Number</label>
                <input class="form-control" type="text" id="phoneNumber" name="phone_number" value="{{ old('phone_number') }}" placeholder="01700000000">
            </div>
        </div>
        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="emailaddress">Email address<span class="text-danger">*</span></label>
                <input class="form-control" type="email" id="emailaddress" name="email" value="{{ old('email') }}"  placeholder="john@deo.com">
                @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="password">Password<span class="text-danger">*</span></label>
                <input class="form-control" type="password"  id="password" name="password" placeholder="Enter your password">
                @error('password')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="password-confirm">Confirm Password<span class="text-danger">*</span></label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Re-type your password">
            </div>
        </div>

        <div class="form-group row m-b-20">
            <div class="col-12">

                <div class="checkbox checkbox-custom">
                    <input id="remember" type="checkbox" checked="">
                    <label for="remember">
                        I accept <a href="#" class="text-custom">Terms and Conditions</a>
                    </label>
                </div>

            </div>
        </div>

        <div class="form-group row text-center m-t-10">
            <div class="col-12">
                <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign Up Free</button>
            </div>
        </div>

    </form>

    <div class="row m-t-50">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Already have an account?  <a href="{{route('login')}}" class="text-dark m-l-5"><b>Log In</b></a></p>
        </div>
    </div>

</div>
@endsection
