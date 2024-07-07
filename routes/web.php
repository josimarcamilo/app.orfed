<?php

use App\Livewire\Accounts;
use App\Livewire\DashboardBudget;
use App\Livewire\Budgets;
use App\Models\BraipWebhook;
use App\Models\WhatsAppWebhook;
use Illuminate\Support\Facades\Route;

Route::view('/politica-privacidade', 'politica-privacidade');

Route::get('/hooks-whatsapp', function(){
    $model = new WhatsAppWebhook();
    $model->saveWebhook(request()->all());

    if(request()->hub_challenge){
        return request()->hub_challenge;
    }
});

Route::post('/hooks-whatsapp', function(){
    $model = new WhatsAppWebhook();
    $model->saveWebhook(request()->all());

    return response()->json();
});

Route::get('/hooks-braip', function(){
    $model = new BraipWebhook();
    $model->saveWebhook(request()->all());

    return response()->json();
});

Route::post('/hooks-braip', function(){
    $model = new BraipWebhook();
    $model->saveWebhook(request()->all());

    return response()->json();
});

Route::get('/accounts', Accounts::class)->middleware('auth')->name('home');
Route::get('/accounts/{account}/budgets', Budgets::class)->middleware('auth');
Route::get('/accounts/{account}/budgets/{budget}', DashboardBudget::class)->middleware('auth');

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
