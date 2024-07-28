@extends('Auth.layouts.main')
@section('content')
    
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('login') }}" method="POST" >
                @csrf
                <h1>Đăng nhập</h1>
                <div class="social-container">
                    <a href="{{ route('auth.fb') }}" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ route('auth.google') }}" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                @if (session('success'))
                    <p class="text-success text-center">{{ session('success') }}</p>
                @endif
                <input type="email" placeholder="Email" name="email">
                @error('email')
                        <small class="text-danger">{{ $errors->first('email')  }}</small>
                @enderror
                <input type="password" placeholder="Password" name="password">
                @error('password')
                        <small class="text-danger">{{ $errors->first('password')  }}</small>
                @enderror
                @if (session('error'))
                                <p class="text-danger text-center">{{ session('error') }}</p>
                            @endif
                <a href="{{ route('password.request') }}">Forgot your password?</a>
                <button type="submit">Đăng nhập</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <h2>Forgot Password</h2>
                @if (session('status'))
                    <div>{{ session('status') }}</div>
                @endif
                @if ($errors->has('email'))
                    <div>{{ $errors->first('email') }}</div>
                @endif
                <div class="mt-4">
                    <label for="email">Email:</label><br>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <button type="submit">Reset Password </button>
                </div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Hello, Friend!</h1>
                    <p>Get your information back</p>
                    <button class="ghost" id="signIn">trở lại</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome Back!</h1>
                    <p>Keep checking in with us</p>
                    <button class="ghost" id="signUp">Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>

@endsection