@extends('layouts.navigation')
@section('title', 'Login')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <form method="POST" action="{{ route('login') }}" class="p-4 border rounded">
            <h2 class="text-center mb-4">Login to Inspiro</h2>
            <p class="text-center text-muted mb-4">
                Access your account to share and explore inspiration.
            </p>
            
            @csrf          
            <div class="mb-3">
                <label for="email" class="form-label"><b>Email:</b></label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control">
                @error('email')
                    <span class="text-danger text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><b>Password:</b></label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                @error('password')
                    <span class="text-danger text-sm mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 stylish-text" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" class="stylish-btn w-100 mt-3">
                    Log in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
