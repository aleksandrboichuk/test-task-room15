@extends('layouts.main')

@section('title', 'Sign Up')

@section('style')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <div class="signup-form mt-20">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <h2>Create Account</h2>
            <p class="lead"></p>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name" required="required">
                </div>

            </div>
            @error('name')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
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
                <div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-lock"></i>
					<i class="fa fa-check"></i>
				</span>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="{{route('login')}}">Login here</a>.</div>
    </div>
@endsection
