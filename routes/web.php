<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/test-auth', function () {
    auth()->login(\App\Models\User::first());
    return auth()->user();
});
Route::get('/test', fn() => dd(auth()->user()));
