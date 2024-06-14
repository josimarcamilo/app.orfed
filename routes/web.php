<?php

use App\Livewire\Accounts;
use App\Livewire\Budgets;
use Illuminate\Support\Facades\Route;

Route::get('/accounts', Accounts::class)->middleware('auth')->name('home');
Route::get('/accounts/{account}/budgets', Budgets::class)->middleware('auth');

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
