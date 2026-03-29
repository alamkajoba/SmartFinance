<?php

use App\Livewire\Module\User\UserCreate;
use App\Livewire\Module\User\UserIndex;
use App\Livewire\Module\User\UserUpdate;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login');

//USER ROUTES
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('index', UserIndex::class)->name('index');
    Route::get('create', UserCreate::class)->name('create');
    Route::get('reregistrationupdate/{id}', UserUpdate::class)->name('update');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
