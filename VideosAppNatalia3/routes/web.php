<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\TeamController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('videos/{video}', [VideosController::class, 'show'])->name('videos.show');
Route::put('/teams/{team}/members/{user}', [TeamController::class, 'updateRole']);
Route::put('/videos/{video}', [VideosController::class, 'update'])->name('videos.update');

Route::middleware('auth')->group(function () {
    Route::get('/videos/{id}/edit', [VideosController::class, 'edit'])->name('videos.edit');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
