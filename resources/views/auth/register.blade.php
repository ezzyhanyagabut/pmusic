@extends('layouts.guest')

@section('title', 'Register - pMusic')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="logo">p<span>Music</span></div>
        <p class="subtitle">Buat akun dan buka gerbang ke galaksi lagu 🚀</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-input"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input"
                       value="{{ old('email') }}" required>
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

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>

            <button type="submit" class="btn-auth">Daftar</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
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
