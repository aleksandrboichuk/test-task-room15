@extends('layouts.main')

@section('title', 'Sign In')

@section('style')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <div class="signup-form mt-20">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <h2>Login</h2>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{old('email')}}" required="required">
                </div>
            </div>
            @error('email')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
            </div>
            @error('password')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
            </div>
        </form>
        <div class="text-center">Do not have an account? <a href="{{route('register')}}">Sign Up here</a>.</div>
    </div>
@endsection
