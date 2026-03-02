<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Email Verification
Route::middleware('auth')->group(function () {
    Route::get('email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/verification-notification', [VerificationController::class, 'resend'])->name('verification.resend');
});

// Google OAuth
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

// Discussions
Route::resource('discussions', DiscussionController::class);
Route::post('discussions/{discussion}/best-answer/{comment}', [DiscussionController::class, 'setBestAnswer'])
    ->name('discussions.best-answer.set');
Route::delete('discussions/{discussion}/best-answer', [DiscussionController::class, 'removeBestAnswer'])
    ->name('discussions.best-answer.remove');
Route::post('discussions/{discussion}/toggle-solved', [DiscussionController::class, 'toggleSolved'])
    ->name('discussions.toggle-solved');

// Comments
Route::post('discussions/{discussion}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Reactions
Route::post('reactions/toggle', [ReactionController::class, 'toggle'])->name('reactions.toggle');

// Members/Anggota
Route::get('/anggota', [ProfileController::class, 'index'])->name('members.index');

// Profile
Route::get('/@{user:username}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
