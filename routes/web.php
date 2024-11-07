<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('app', 'app')
    ->middleware(['auth', 'verified'])
    ->name('app');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('inventory-form', 'inventory-form')
    ->middleware(['auth'])
    ->name('inventory-form');

require __DIR__.'/auth.php';
