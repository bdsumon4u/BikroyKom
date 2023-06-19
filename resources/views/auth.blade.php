@extends('layouts.yellow.master')

@section('title', 'Authentication')

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/') => 'Home',
    ],
    'active' => 'Auth',
    'page_title' => 'Authentication'
])


<div class="block">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card flex-grow-1 mb-md-0">
                    <div class="card-body">
                        <h3 class="card-title">Login</h3>
                        <x-form :action="route('user.login')" method="post">
                            <div class="form-group">
                                <label>Email Address</label> <span class="text-danger">*</span>
                                <x-input type="email" name="login" placeholder="Enter Email" />
                                <x-error field="login" />
                            </div>
                            <div class="form-group">
                                <label>Password</label> <span class="text-danger">*</span>
                                <x-input type="password" name="password" placeholder="Password" />
                                <x-error field="password" />
                                <small class="form-text text-muted">
                                    <a href="{{ route('user.password.request') }}">Forgot Password?</a>
                                </small>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <span class="form-check-input input-check">
                                        <span class="input-check__body">
                                            <input class="input-check__input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="input-check__box"></span>
                                            <svg class="input-check__icon" width="9px" height="7px">
                                                <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                            </svg>
                                        </span>
                                    </span>
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Login</button>
                        </x-form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex mt-4 mt-md-0">
                <div class="card flex-grow-1 mb-0">
                    <div class="card-body">
                        <h3 class="card-title">Register</h3>
                        <x-form :action="route('user.register')" method="post">
                            <div class="form-group">
                                <label>Name</label> <span class="text-danger">*</span>
                                <x-input name="name" placeholder="Enter Your Name" />
                                <x-error field="name" />
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 pr-1">
                                    <label>Email Address</label> <span class="text-danger">*</span>
                                    <x-input type="email" name="email" placeholder="Enter Email" />
                                    <x-error field="email" />
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label>Phone Number</label> <span class="text-danger">*</span>
                                    <x-input name="phone_number" placeholder="Enter Phone Number" value="+880" />
                                    <x-error field="phone_number" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 pr-1">
                                    <label>Password</label> <span class="text-danger">*</span>
                                    <x-input type="password" name="password" placeholder="Password" />
                                    <x-error field="password" />
                                </div>
                                <div class="form-group col-md-6 pl-1">
                                    <label>Confirm Password</label> <span class="text-danger">*</span>
                                    <x-input type="password" name="password_confirmation" placeholder="Retype Password" />
                                    <x-error field="password_confirmation" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Register</button>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection