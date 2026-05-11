@extends('layouts.app')

@section('title', 'pMusic - Home')

@section('content')
<div class="container">

    <!-- 1. Banner Artis Trending -->
    <section class="hero-banner">
        <img src="{{ asset('images/banner.jpg') }}" alt="Artis Trending">
        <div class="banner-text">
            <span>NOW TRENDING</span>
            <h2>The 1975 - About You</h2>
            <button class="btn btn-primary play-btn"
                    data-youtubeid="LZLZ36Vtah4"
                    data-title="About You"
                    data-artist="The 1975"
                    data-cover="{{ asset('images/banner.jpg') }}">
                ▶ Dengerin Sekarang
            </button>
        </div>
    </section>

    <!-- 2. Playlist Untukmu -->
    <section class="section">
        <h3 class="section-title">Playlist Untukmu</h3>
        <div class="playlist-grid">
            <div class="playlist-card">
                <div class="playlist-cover" style="background: linear-gradient(45deg, #1DB954, #191414);">
                    <p>Top Hits Indonesia</p>
                </div>
            </div>
            <div class="playlist-card">
                <div class="playlist-cover" style="background: linear-gradient(45deg, #8E44AD, #2C3E50);">
                    <p>Chill Malam Minggu</p>
                </div>
	    </div>
            <div class="playlist-card">
                <div class="playlist-cover" style="background: linear-gradient(45deg, #E74C3C, #C0392B);">
                    <p>Workout Energy</p>
                </div>
            </div>
            <div class="playlist-card">
                <div class="playlist-cover" style="background: linear-gradient(45deg, #F1C40F, #F39C12);">
                    <p>Akhirnya Diputar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Daftar Lagu Trending - Sekarang Bisa Diklik -->
    <section class="section">
        <h3 class="section-title">Trending Sekarang</h3>
        <div class="song-list">
            
            <div class="song-item play-btn" 
                 data-youtubeid="C3zxfnC0Jrk"
                 data-title="Cincin"
                 data-artist="Hindia"
                 data-cover="https://i.scdn.co/image/ab67616d0000b273c5f4e2c3e0e6a1c8b2b3b4b5">
                <img src="https://i.scdn.co/image/ab67616d0000b273c5f4e2c3e0e6a1c8b2b3b4b5" class="song-cover">
                <div class="song-info">
                    <p class="song-title">Cincin</p>
                    <p class="song-artist">Hindia</p>
                </div>
                <div class="song-duration">2:55</div>
            </div>

            <div class="song-item play-btn" 
                 data-youtubeid="V9PVRfjEBTI"
                 data-title="BIRDS OF A FEATHER"
                 data-artist="Billie Eilish"
                 data-cover="https://i.scdn.co/image/ab67616d0000b273d8d8">
                <img src="https://i.scdn.co/image/ab67616d0000b273d8d8d8d8" class="song-cover">
                <div class="song-info">
                    <p class="song-title">BIRDS OF A FEATHER</p>
                    <p class="song-artist">Billie Eilish</p>
                </div>
                <div class="song-duration">3:30</div>
            </div>

            <div class="song-item play-btn" 
                 data-youtubeid="2Vv-BfVoq4g"
                 data-title="Garam & Madu"
                 data-artist="Tenxi, Jemsii"
                 data-cover="https://i.scdn.co/image/ab67616d0000b273a1a1a1a1">
                <img src="https://i.scdn.co/image/ab67616d0000b273a1a1a1a1" class="song-cover">
                <div class="song-info">
                    <p class="song-title">Garam & Madu</p>
                    <p class="song-artist">Tenxi, Jemsii</p>
                </div>
                <div class="song-duration">3:12</div>
            </div>

        </div>
    </section>

</div>
@endsection
