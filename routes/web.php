<?php

use Illuminate\Support\Facades\Route;

$seller = config('landing.seller', []);
$hasSellerDetails = collect($seller)->contains(fn ($value) => filled($value));
$hasContactDetails = filled($seller['email'] ?? null) || filled($seller['phone'] ?? null);
$hasSellerIdentity = filled($seller['name'] ?? null)
    || filled($seller['status'] ?? null)
    || filled($seller['inn'] ?? null)
    || filled($seller['ogrn'] ?? null);

$viewData = compact('seller', 'hasSellerDetails', 'hasContactDetails', 'hasSellerIdentity');

Route::view('/', 'landing', $viewData)->name('home');
Route::view('/offer', 'legal.offer', $viewData)->name('offer');
Route::view('/privacy', 'legal.privacy', $viewData)->name('privacy');
Route::view('/personal-data', 'legal.personal-data', $viewData)->name('personal-data');
