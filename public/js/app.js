/* ===== pMusic - Player + Sidebar Lengkap ===== */
console.log('1. app.js loaded');

let player;
let isPlayerReady = false;
let progressInterval;
let currentVideoId = '';

// 1. YouTube API - WAJIB GLOBAL
function onYouTubeIframeAPIReady() {
    console.log('2. YouTube API Ready');
    player = new YT.Player('youtubePlayer', {
        height: '100%', 
        width: '100%',
        playerVars: { 
            'playsinline': 1, 
            'controls': 0, 
            'disablekb': 1,
            'rel': 0,
            'modestbranding': 1,
            'iv_load_policy': 3,
            'origin': window.location.origin
        },
        events: { 
            'onReady': onPlayerReady, 
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
    });
}

function onPlayerReady(event) {
    isPlayerReady = true;
    console.log('3. Player Ready - Iframe udah jadi');
    // Pancing biar iframe render walau kosong
    event.target.cueVideoById('');
}

function onPlayerError(e) {
    console.log('YT Error:', e.data);
    if (e.data === 150 || e.data === 101) {
        alert('Video tidak bisa diputar karena dibatasi pemiliknya');
    }
}

function onPlayerStateChange(e) {
    console.log('4. State:', e.data);
    const isPlaying = e.data === YT.PlayerState.PLAYING;
    
    document.getElementById('playPauseMini').textContent = isPlaying ? '⏸' : '▶';
    document.getElementById('playPauseFull').textContent = isPlaying ? '⏸' : '▶';

    if (isPlaying) {
        clearInterval(progressInterval);
        progressInterval = setInterval(updateProgress, 1000);
    } else {
        clearInterval(progressInterval);
    }
    
    // Kalo video abis, balik ke mini
    if (e.data === YT.PlayerState.ENDED) {
        openMini();
    }
}

function updateProgress() {
    if (!player || typeof player.getDuration !== 'function') return;
    
    const duration = player.getDuration();
    const current = player.getCurrentTime();
    
    if (duration > 0) {
        const seekBar = document.getElementById('seekBar');
        seekBar.max = duration;
        seekBar.value = current;
        document.getElementById('currentTime').textContent = formatTime(current);
        document.getElementById('duration').textContent = formatTime(duration);
    }
}

function formatTime(s) {
    if (isNaN(s) || s < 0) return '0:00';
    const m = Math.floor(s / 60);
    const sec = Math.floor(s % 60).toString().padStart(2, '0');
    return `${m}:${sec}`;
}

// 2. DOM READY - SEMUA LOGIC DISINI
document.addEventListener('DOMContentLoaded', function() {
    console.log('5. DOM Ready');
    
    // ===== SIDEBAR =====
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const openSidebar = document.getElementById('openSidebar');
    const closeSidebar = document.getElementById('closeSidebar');

    function openNav() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
    }
    
    function closeNav() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    }

    openSidebar.onclick = openNav;
    closeSidebar.onclick = closeNav;
    overlay.onclick = closeNav;

    // ===== PLAYER ELEMENTS =====
    const playerMiniEl = document.getElementById('playerMini');
    const playerFullEl = document.getElementById('playerFull');
    const seekBar = document.getElementById('seekBar');
    
    // ===== PLAYER OPEN/CLOSE =====
    function openFull() {
        playerFullEl.classList.add('active');
        playerMiniEl.classList.remove('active');
    }
    
    function openMini() {
        playerFullEl.classList.remove('active');
        if (currentVideoId) playerMiniEl.classList.add('active');
    }

    document.getElementById('closeFullPlayer').onclick = openMini;
    document.getElementById('expandPlayer').onclick = openFull;

    // ===== TOMBOL PLAY DI LIST LAGU =====
    document.querySelectorAll('.play-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('6. Tombol dipencet:', this.dataset.youtubeid);
            if (!isPlayerReady) {
                console.log('Player belum ready');
                return;
            }
            
            currentVideoId = this.dataset.youtubeid;
            const title = this.dataset.title || 'Unknown Title';
            const artist = this.dataset.artist || 'Unknown Artist';
            
            // Update Info
            document.getElementById('playerTitleMini').textContent = title;
            document.getElementById('playerArtistMini').textContent = artist;
            document.getElementById('playerTitleFull').textContent = title;
            document.getElementById('playerArtistFull').textContent = artist;

            // Load & Play
            player.loadVideoById(currentVideoId);
            player.playVideo();
            
            // Munculin player
            playerMiniEl.classList.add('active');
            openFull();
        });
    });

    // ===== CONTROL PLAY/PAUSE =====
    function togglePlay() {
        if (!player || !isPlayerReady) return;
        const state = player.getPlayerState();
        if (state === YT.PlayerState.PLAYING) {
            player.pauseVideo();
        } else {
            player.playVideo();
        }
    }
    
    document.getElementById('playPauseMini').onclick = togglePlay;
    document.getElementById('playPauseFull').onclick = togglePlay;

    // ===== SEEK BAR =====
    seekBar.addEventListener('input', function() {
        if (player && isPlayerReady) {
            player.seekTo(this.value, true);
        }
    });

    // ===== PREV/NEXT =====
    document.getElementById('prevBtn').onclick = function() {
        console.log('Prev clicked - belum diisi');
    };
    
    document.getElementById('nextBtn').onclick = function() {
        console.log('Next clicked - belum diisi');
    };
});
