<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');
Route::view('/offer', 'legal.offer')->name('offer');
Route::view('/privacy', 'legal.privacy')->name('privacy');
Route::view('/personal-data', 'legal.personal-data')->name('personal-data');
