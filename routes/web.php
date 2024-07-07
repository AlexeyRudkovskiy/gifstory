<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $player = \App\Models\Player::first();
    return $player;
});
