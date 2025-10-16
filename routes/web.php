<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Models\Option;


Route::get('/', [PollController::class, 'index']);
Route::post('/vote', [PollController::class, 'vote'])->name('vote');
Route::post('/reset', [PollController::class, 'reset'])->name('reset');
