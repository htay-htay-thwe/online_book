<?php

use App\Http\Controllers\BoughtController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [UserController::class, 'adminDashboard'])->name('dashboard');
    Route::post('/dashboard', [UserController::class, 'adminInput'])->name('admin#input');
});

Route::group(['prefix' => 'post'], function () {
    Route::post('genre/create', [GenreController::class, 'createGenre'])->name('genre#create');
    Route::get('create', [PostController::class, 'postCreatePage'])->name('post#createPage');
    Route::post('create', [PostController::class, 'postCreate'])->name('post#create');
    Route::get('delete/{id}', [PostController::class, 'postDelete'])->name('post#delete');
    Route::get('post/edit/page/{id}', [PostController::class, 'postEditPage'])->name('post#editPage');
    Route::post('post/update', [PostController::class, 'postUpdate'])->name('post#update');
    Route::get('/order/client', [BoughtController::class, 'order'])->name('order#client');
    Route::post('update/order/status', [BoughtController::class, 'updateOrder'])->name('update#order');
    Route::post('search', [BoughtController::class, 'search'])->name('search');
});

Route::prefix('order')->group(function () {
    Route::get('ajax/status', [BoughtController::class, 'ajaxStatus'])->name('admin#ajaxStatus');
    Route::get('ajax/change/status', [BoughtController::class, 'changeStatus']);
});
