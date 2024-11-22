<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;

Route::get('/', [PageController::class , 'home'])->name('home'); 
Route::get('/manga_detail/{id}', [PageController::class , 'manga_detail'])->name('manga_detail'); 
Route::get('/chapter_detail/{id}', [PageController::class , 'chapter_detail'])->name('chapter_detail');
Route::get('/category_detail/{id}', [PageController::class , 'category_detail'])->name('category_detail');
Route::post('/manga/{id}/comment', [CommentController::class, 'store'])->name('manga.comment.store');
Route::get('/search', [PageController::class, 'search'])->name('search_manga');
Route::resource('comment',CommentController::class);
Route::post('/comment/{comment}/reply', [CommentController::class, 'reply'])->name('comment.reply');
Route::resource('user',UserController::class);
Route::post('/manga/{id}/like', [MangaController::class, 'likeManga'])->name('manga.like')->middleware('auth');

Route::get('/login', [PageController::class , 'login'])->name('login');
Route::get('/register', [PageController::class , 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/check_info', [PageController::class, 'check_info'])->name('check_info');
Route::post('/check_account', [PageController::class, 'check_account'])->name('check_account');
Route::post('/reset_password/{user_id}', [PageController::class, 'reset_password'])->name('reset_password');
Route::get('/reset_password/{user_id}', [PageController::class, 'showResetPasswordForm'])->name('show_reset_password');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::resource('category', CategoryController::class);
    Route::resource('manga', MangaController::class);
    Route::resource('chapter', ChapterController::class);
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
});
