@extends('layouts.guest')

@section('title', 'Login - pMusic')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="logo">p<span>Music</span></div>
        <p class="subtitle">Masuk dan lanjutkan petualangan musikmu 🎧</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
                @error('password')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <label class="remember">
                <input type="checkbox" name="remember">
                Ingat saya
            </label>

            <button type="submit" class="btn-auth">Masuk</button>
        </form>

        <div class="auth-footer">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </div>

        <a href="{{ url('/') }}" class="back-home">← Kembali ke Home</a>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/auth.js') }}"></script>
@endpush
