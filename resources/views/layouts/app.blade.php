<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'pMusic - Dengerin Musik Dunia')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <a href="#" class="btn-premium">Upgrade</a>
                <div class="avatar">U</div>
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
            <li class="active"><a href="/">Home</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">Library</a></li>
            <li><a href="#">Liked Songs</a></li>
        </ul>
    </div>
    <div class="overlay" id="overlay"></div>

    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

    <!-- Player Mini - Muncul pas full screen ditutup -->
    <!-- Player Mini -->
<div class="player-mini" id="playerMini">
    <div class="mini-video-wrap">
        <div id="youtubePlayer"></div> <!-- CUMA INI SATU-SATUNYA -->
    </div>
    <div class="mini-info">
        <p id="playerTitleMini" class="mini-title">Pilih lagu</p>
        <p id="playerArtistMini" class="mini-artist">pMusic</p>
    </div>
    <div class="mini-controls">
        <button id="playPauseMini">▶</button>
        <button id="expandPlayer">▲</button>
    </div>
</div>

<!-- Player Full Screen -->
<div class="player-full" id="playerFull">
    <div class="full-header">
        <button id="closeFullPlayer">▼</button>
        <span class="full-header-title">Now Playing</span>
        <span></span>
    </div>

    <!-- KOSONGIN, NANTI DIISI JS -->
    <div class="full-video-wrap" id="fullVideoWrap"></div>

    <div class="full-info">
        <h2 id="playerTitleFull">Judul Lagu</h2>
        <p id="playerArtistFull">Nama Artis</p>
    </div>

    <div class="progress-bar">
        <span id="currentTime">0:00</span>
        <input type="range" id="seekBar" value="0" step="1">
        <span id="duration">0:00</span>
    </div>

    <div class="full-controls">
        <button id="prevBtn">⏮</button>
        <button id="playPauseFull">▶</button>
        <button id="nextBtn">⏭</button>
    </div>
</div>
    
    @yield('scripts')
    <script src="https://www.youtube.com/iframe_api"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <script>eruda.init();</script>
</body>
</html>
