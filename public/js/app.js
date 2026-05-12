// =========================================================
// pMusic Player Script
// YouTube Iframe API + Mini Player + Full Player
// Auto Next Song + Custom Controls
// =========================================================

let player;
let isPlayerReady = false;
let currentVideoId = null;

// Playlist
let playlist = [];
let currentIndex = 0;

// Elements
const playerMiniEl = document.getElementById('playerMini');
const playerFullEl = document.getElementById('playerFull');

const playPauseMiniBtn = document.getElementById('playPauseMini');
const playPauseFullBtn = document.getElementById('playPauseFull');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

const expandPlayerBtn = document.getElementById('expandPlayer');
const closeFullPlayerBtn = document.getElementById('closeFullPlayer');

const seekBar = document.getElementById('seekBar');
const currentTimeEl = document.getElementById('currentTime');
const durationEl = document.getElementById('duration');

let progressInterval = null;

// =========================================================
// YouTube API Ready
// =========================================================
window.onYouTubeIframeAPIReady = function () {
    console.log('YouTube API ready');

    player = new YT.Player('youtubePlayer', {
        height: '0',
        width: '0',
        videoId: '',
        playerVars: {
            autoplay: 0,
            controls: 0,
            disablekb: 1,
            modestbranding: 1,
            rel: 0,
            fs: 0,
            iv_load_policy: 3,
        },
        events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerStateChange,
            onError: onPlayerError,
        },
    });
};

function onPlayerReady() {
    console.log('Player ready');
    isPlayerReady = true;
    buildPlaylist();
}

// =========================================================
// Build Playlist
// =========================================================
function buildPlaylist() {
    playlist = Array.from(document.querySelectorAll('.play-btn'));

    playlist.forEach((btn, index) => {
        btn.addEventListener('click', function () {
            currentIndex = index;
            playSong(this);
        });
    });

    console.log('Playlist loaded:', playlist.length, 'songs');
}

// =========================================================
// Play Song
// =========================================================
function playSong(element) {
    if (!isPlayerReady) {
        console.log('Player belum ready');
        return;
    }

    const videoId = element.dataset.youtubeid;
    const title = element.dataset.title || 'Unknown Title';
    const artist = element.dataset.artist || 'Unknown Artist';
    const cover = element.dataset.cover || '';

    currentVideoId = videoId;

    // Update mini player
    setText('playerTitleMini', title);
    setText('playerArtistMini', artist);

    // Update full player
    setText('playerTitleFull', title);
    setText('playerArtistFull', artist);

    // Cover
    setImage('playerCoverMini', cover);
    setImage('playerCoverFull', cover);

    // Optional artist section
    setText('artistName', artist);

    // Play video
    player.loadVideoById(videoId);

    // Show mini player
    playerMiniEl?.classList.add('active');
}

// =========================================================
// Helper Functions
// =========================================================
function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
}

function setImage(id, src) {
    const el = document.getElementById(id);
    if (el) el.src = src;
}

// =========================================================
// Play / Pause
// =========================================================
function togglePlayPause() {
    if (!player || !isPlayerReady) return;

    const state = player.getPlayerState();

    if (
        state === YT.PlayerState.PLAYING ||
        state === YT.PlayerState.BUFFERING
    ) {
        player.pauseVideo();
    } else {
        player.playVideo();
    }
}

playPauseMiniBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    togglePlayPause();
});

playPauseFullBtn?.addEventListener('click', togglePlayPause);

// =========================================================
// Prev / Next
// =========================================================
function playNextSong() {
    if (playlist.length === 0) return;

    currentIndex++;

    if (currentIndex >= playlist.length) {
        currentIndex = 0;
    }

    playSong(playlist[currentIndex]);
}

function playPrevSong() {
    if (playlist.length === 0) return;

    currentIndex--;

    if (currentIndex < 0) {
        currentIndex = playlist.length - 1;
    }

    playSong(playlist[currentIndex]);
}

nextBtn?.addEventListener('click', playNextSong);
prevBtn?.addEventListener('click', playPrevSong);

// =========================================================
// Full Player Open / Close
// =========================================================
function openFull() {
    playerFullEl?.classList.add('active');
    document.body.classList.add('player-open');
}

function closeFull() {
    playerFullEl?.classList.remove('active');
    document.body.classList.remove('player-open');
}

playerMiniEl?.addEventListener('click', (e) => {
    // Jika klik tombol mini, jangan buka full
    if (e.target.closest('button')) return;
    openFull();
});

expandPlayerBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    openFull();
});

closeFullPlayerBtn?.addEventListener('click', closeFull);

// =========================================================
// YouTube State Change
// =========================================================
function onPlayerStateChange(event) {
    switch (event.data) {
        case YT.PlayerState.PLAYING:
            updatePlayButtons(true);
            startProgressUpdater();
            break;

        case YT.PlayerState.PAUSED:
            updatePlayButtons(false);
            stopProgressUpdater();
            break;

        case YT.PlayerState.ENDED:
            updatePlayButtons(false);
            stopProgressUpdater();
            playNextSong();
            break;
    }
}

function onPlayerError(event) {
    console.error('YouTube Error:', event.data);

    // Jika video error, otomatis lanjut lagu berikutnya
    playNextSong();
}

// =========================================================
// Update Play Buttons
// =========================================================
function updatePlayButtons(isPlaying) {
    const icon = isPlaying ? '⏸' : '▶';

    if (playPauseMiniBtn) playPauseMiniBtn.textContent = icon;
    if (playPauseFullBtn) playPauseFullBtn.textContent = icon;
}

// =========================================================
// Progress Bar
// =========================================================
function startProgressUpdater() {
    stopProgressUpdater();

    progressInterval = setInterval(() => {
        if (!player || typeof player.getCurrentTime !== 'function') return;

        const current = player.getCurrentTime();
        const duration = player.getDuration();

        if (!duration || isNaN(duration)) return;

        if (currentTimeEl) currentTimeEl.textContent = formatTime(current);
        if (durationEl) durationEl.textContent = formatTime(duration);

        if (seekBar) {
            seekBar.max = Math.floor(duration);
            seekBar.value = Math.floor(current);
        }
    }, 1000);
}

function stopProgressUpdater() {
    if (progressInterval) {
        clearInterval(progressInterval);
        progressInterval = null;
    }
}

function formatTime(seconds) {
    seconds = Math.floor(seconds);

    const minutes = Math.floor(seconds / 60);
    const secs = seconds % 60;

    return `${minutes}:${secs.toString().padStart(2, '0')}`;
}

// =========================================================
// Seek Bar
// =========================================================
seekBar?.addEventListener('input', function () {
    if (!player || !isPlayerReady) return;

    player.seekTo(parseInt(this.value), true);
});

// =========================================================
// Keyboard Shortcuts
// =========================================================
document.addEventListener('keydown', function (e) {
    // Jangan ganggu saat mengetik di input
    const tag = document.activeElement.tagName.toLowerCase();
    if (tag === 'input' || tag === 'textarea') return;

    switch (e.code) {
        case 'Space':
            e.preventDefault();
            togglePlayPause();
            break;

        case 'ArrowRight':
            playNextSong();
            break;

        case 'ArrowLeft':
            playPrevSong();
            break;

        case 'Escape':
            closeFull();
            break;
    }
});

// =========================================================
// Debug Helper
// =========================================================
window.pMusic = {
    playNextSong,
    playPrevSong,
    togglePlayPause,
    openFull,
    closeFull,
};

console.log('pMusic app.js loaded');

/* =========================================
   DOM Ready
========================================= */
document.addEventListener('DOMContentLoaded', function () {
    console.log('📄 DOM Ready');

    playerMiniEl = document.getElementById('playerMini');
    playerFullEl = document.getElementById('playerFull');

    // Ambil semua tombol play
    const playButtons = document.querySelectorAll('.play-btn');

    playlist = Array.from(playButtons).map((btn) => ({
        youtubeId: btn.dataset.youtubeid,
        title: btn.dataset.title,
        artist: btn.dataset.artist,
        cover: btn.dataset.cover,
        artistPhoto: btn.dataset.artistPhoto,
        artistGenre: btn.dataset.artistGenre,
        artistBio: btn.dataset.artistBio
    }));

    // Klik lagu
    playButtons.forEach((btn, index) => {
        btn.addEventListener('click', function () {
            playSong(index);
        });
    });

    // Play/Pause
    document.getElementById('playPauseMini')?.addEventListener('click', function (e) {
        e.stopPropagation();
        togglePlay();
    });

    document.getElementById('playPauseFull')?.addEventListener('click', togglePlay);

    // Next/Prev
    document.getElementById('nextBtn')?.addEventListener('click', playNextSong);
    document.getElementById('prevBtn')?.addEventListener('click', playPrevSong);

    // Open Full
    document.getElementById('expandPlayer')?.addEventListener('click', function (e) {
        e.stopPropagation();
        openFull();
    });

    playerMiniEl?.addEventListener('click', function (e) {
        if (e.target.closest('button')) return;
        openFull();
    });

    // Close Full
    document.getElementById('closeFullPlayer')?.addEventListener('click', openMini);

    // Seek Bar
    document.getElementById('seekBar')?.addEventListener('input', function () {
        if (!player || !isPlayerReady) return;
        player.seekTo(parseInt(this.value), true);
    });
});
