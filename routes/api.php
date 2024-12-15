<?php

use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\QuestionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', fn () => auth()->user())->name('api.me');
});

// Room endpoints
Route::get('rooms', [RoomController::class, 'index'])->name('room.index');
Route::put('room', [RoomController::class, 'create'])->name('room.store');
Route::post('room/{room}', [RoomController::class, 'join'])->name('room.join');

Route::middleware([ \App\Http\Middleware\AuthPlayer::class ])->group(function () {
    // Question endpoints
    Route::get('room/{room}/question', [QuestionController::class, 'nextQuestion'])->name('room.next_question');
    Route::put('room/{room}/question/{question}', [QuestionController::class, 'answer'])->name('room.question.answer');
    Route::get('room/{room}/question/{question}', [QuestionController::class, 'answers'])->name('room.question.answers');
});
