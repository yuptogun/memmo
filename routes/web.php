<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemmoController;

Route::controller(MemmoController::class)->group(function () {
    Route::get('/',              'index')->name('index');
    Route::get('/about',         'about')->name('about');
    Route::get('/m/{shareCode}', 'showShared')->name('show-shared');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
