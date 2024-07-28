@extends('Auth.layouts.main')
@section('content')

    <div class="container">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <h2>Reset Password</h2>
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" value="{{ $email }}" readonly>
            </div>
            <div>
                <label for="password">New Password:</label><br>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm New Password:</label><br>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div>
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
    
@endsection

