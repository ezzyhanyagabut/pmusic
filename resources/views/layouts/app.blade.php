<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'pMusic - Dengerin Musik Dunia')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container">
            <div class="nav-left">
                <div class="hamburger" id="openSidebar">☰</div>
                <div class="logo">p<span>Music</span></div>
            </div>

            <div class="nav-right">
                @guest
                    <a href="{{ route('login') }}" class="btn-premium">Login</a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn-premium">Dashboard</a>
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">p<span>Music</span></div>
            <div class="close-btn" id="closeSidebar">✕</div>
        </div>

<ul class="sidebar-menu">
    <li class="active"><a href="{{ route('home') }}"> Home</a></li>
<li>
    <a href="{{ route('search') }}">Search</a>
</li>
    <li><a href="#">Albums</a></li>
    <li><a href="#">Artists</a></li>
    <li><a href="#">Liked Songs</a></li>
    <li><a href="#">Bookmarks</a></li>

    @auth
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link logout-btn">
                    Logout
                </button>
            </form>
        </li>
    @endauth
</div>
    <div class="overlay" id="overlay"></div>

    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

<!-- Mini Player -->
<div class="player-mini" id="playerMini">
    <img
        id="playerCoverMini"
        src="{{ asset('storage/' . $song->album->cover) }}"
        alt="Cover"
        class="player-cover"
    >

    <div class="mini-info">
        <p id="playerTitleMini" class="mini-title">Pilih lagu</p>
        <p id="playerArtistMini" class="mini-artist">pMusic</p>
    </div>

    <div class="mini-controls">
        <button id="playPauseMini">▶</button>
        <button id="expandPlayer">▲</button>
    </div>
</div>

<!-- Full Player -->
<div class="player-full" id="playerFull">
    <div class="full-header">
        <button id="closeFullPlayer">▼</button>
        <span class="full-header-title">Now Playing</span>
        <span></span>
    </div>

    <!-- YouTube Video -->
    <div class="full-video-wrap">
        <div id="youtubePlayer"></div>
    </div>

    <!-- Song Info -->
    <div class="full-info">
        <h2 id="playerTitleFull">Judul Lagu</h2>
        <p id="playerArtistFull">Nama Artis</p>
    </div>

    <!-- Progress -->
    <div class="progress-bar">
        <span id="currentTime">0:00</span>
        <input type="range" id="seekBar" value="0" step="1">
        <span id="duration">0:00</span>
    </div>

    <!-- Controls -->
    <div class="full-controls">
        <button id="prevBtn">⏮</button>
        <button id="playPauseFull">▶</button>
        <button id="nextBtn">⏭</button>
    </div>

    <!-- About Artist -->
    <div class="artist-about-card">
        <h3 class="artist-about-title">Tentang Artis</h3>

        <div class="artist-about-header">
            <img id="playerCoverMini"
     src="{{ asset('storage/' . $song->artist->photo) }}"
     alt="Cover">

<h4 id="artistName">'Unknown Artist</h4>
<p id="artistBio">{{$song->artist->bio}}</p>
    </div>
</div>

@yield('scripts')

<script src="https://www.youtube.com/iframe_api"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
