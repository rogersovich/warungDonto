@extends('layouts.element.login_main')

@section('title', 'Sign In')

@section('content')
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('assets/login/images/signin-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('signUp') }}" class="signup-image-link">Create an account</a>
                </div>
                <div class="signin-form">
                    <h2 class="form-title">Sign In</h2>
                    <form action="{{ route('login') }}" method="POST" class="register-form">
                        @csrf
                        <div class="form-group">
                            <label><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" autofocus placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <button style="width: 100px;" type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
