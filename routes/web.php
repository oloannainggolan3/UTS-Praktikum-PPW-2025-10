<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialController;

Route::get('/', function () {
    return view('welcome');


Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->name('social.callback');

});
