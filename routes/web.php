<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('albums', AlbumController::class);
        Route::resource('songs', SongController::class);
        Route::resource('users', UserController::class);
    });

Route::post('/songs/{song}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('songs.like');

Route::post('/songs/{song}/bookmark', [BookmarkController::class, 'toggle'])
    ->middleware('auth')
    ->name('songs.bookmark');


require __DIR__.'/auth.php';
