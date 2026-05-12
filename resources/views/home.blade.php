@extends('layouts.app')

@section('title', 'pMusic - Home')

@section('content')
<div class="container">

    <!-- 1. Banner Artis Trending -->
@if ($trendingSong)
<section class="hero-banner">
    <img src="{{ asset('storage/' . $trendingSong->album->cover) }}" alt="Trending Song">

    <div class="banner-text">
        <span>NOW TRENDING</span>
        <h2>{{ $trendingSong->artist->name }} - {{ $trendingSong->title }}</h2>

        <button
            class="btn play-btn"
            data-youtubeid="{{ $trendingSong->youtube_id }}"
            data-title="{{ $trendingSong->title }}"
            data-artist="{{ $trendingSong->artist->name }}"
            data-cover="{{ asset('storage/' . $trendingSong->album->cover) }}"
            data-artist-photo="{{ asset('storage/' . $trendingSong->artist->photo) }}"
            data-artist-bio="{{ $trendingSong->artist->bio }}"
        >
            ▶ Dengerin Sekarang
        </button>
    </div>
</section>
@endif

    <!-- 2. Album Untukmu -->
<section class="section">
    <div class="section-header">
        <h3 class="section-title">Album Populer</h3>
    </div>

    <div class="album-scroll">
        @foreach($albums as $album)
            <div class="album-card">
                <img
                    src="{{ asset('storage/' . $album->cover) }}"
                    alt="{{ $album->album_name }}"
                    class="album-cover"
                >

                <h4 class="album-name">{{ $album->album_name }}</h4>
                <p class="album-artist">{{ $album->artist->name ?? $album->artist_name }}</p>
            </div>
        @endforeach
    </div>
</section>

    <!-- 3. List Lagu -->
    <section class="section">
        <h3 class="section-title">List lagu</h3>

        <div class="song-list">
@foreach ($songs as $song)
<div class="song-item play-btn"
     data-youtubeid="{{ $song->youtube_id }}"
     data-title="{{ $song->title }}"
     data-artist="{{ $song->artist->name }}"
     data-cover="{{ asset('storage/' . $song->album->cover) }}">

    <img src="{{ asset('storage/' . $song->album->cover) }}" class="song-cover">

    <div class="song-info">
        <p class="song-title">{{ $song->title }}</p>
        <p class="song-artist">{{ $song->artist->name }}</p>
    </div>
</div>
@endforeach
        </div>
    </section>
</div>
@endsection
