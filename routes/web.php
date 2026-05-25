<?php

use App\Livewire\Module\Categorie\CategorieCreate;
use App\Livewire\Module\Categorie\CategorieIndex;
use App\Livewire\Module\Categorie\CategorieUpdate;
use App\Livewire\Module\Depense\DepenseCreate;
use App\Livewire\Module\Depense\DepenseIndex;
use App\Livewire\Module\Prediction\PredictionIndex;
use App\Livewire\Module\Alerte\AlerteIndex;
use App\Livewire\Module\Transaction\TransactionCreate;
use App\Livewire\Module\Transaction\TransactionIndex;
use App\Livewire\Module\Transaction\TransactionUpdate;
use App\Livewire\Module\User\UserCreate;
use App\Livewire\Module\User\UserIndex;
use App\Livewire\Module\User\UserUpdate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// USER ROUTES
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('index', UserIndex::class)->name('index');
    Route::get('create', UserCreate::class)->name('create');
    Route::get('reregistrationupdate/{id}', UserUpdate::class)->name('update');
});

// CATEGORIE ROUTES
Route::middleware('auth')->prefix('categorie')->name('categorie.')->group(function () {
    Route::get('index', CategorieIndex::class)->name('index');
    Route::get('create', CategorieCreate::class)->name('create');
    Route::get('update/{id}', CategorieUpdate::class)->name('update');
});

// TRANSACTION ROUTES
Route::middleware('auth')->prefix('transaction')->name('transaction.')->group(function () {
    Route::get('index', TransactionIndex::class)->name('index');
    Route::get('create', TransactionCreate::class)->name('create');
    Route::get('update/{id}', TransactionUpdate::class)->name('update');
});

// DEPENSE ROUTES
Route::middleware('auth')->prefix('depense')->name('depense.')->group(function () {
    Route::get('index', DepenseIndex::class)->name('index');
    Route::get('create', DepenseCreate::class)->name('create');
});

// PREDICTION ROUTES
Route::middleware('auth')->prefix('prediction')->name('prediction.')->group(function () {
    Route::get('index', PredictionIndex::class)->name('index');
});

// ALERTE ROUTES
Route::middleware('auth')->prefix('alerte')->name('alerte.')->group(function () {
    Route::get('index', AlerteIndex::class)->name('index');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
