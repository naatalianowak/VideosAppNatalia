<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('videos/{video}', [VideosController::class, 'show'])->name('videos.show');
Route::get('/videos/{id}', [VideosController::class, 'show'])->where('id', '[0-9]+');
Route::get('/videos/manage', [VideosController::class, 'manage'])->name('videos.manage');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
