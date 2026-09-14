<?php

use App\Http\Controllers\LegalDocumentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');

Route::get('/agreement', [LegalDocumentController::class, 'agreement'])->name('agreement');
Route::get('/offer', [LegalDocumentController::class, 'offer'])->name('offer');
Route::get('/personal-data', [LegalDocumentController::class, 'personalData'])->name('personal-data');
Route::get('/cookies', [LegalDocumentController::class, 'cookies'])->name('cookies');
Route::get('/privacy', [LegalDocumentController::class, 'legacyPrivacy'])->name('privacy');

Route::get('/legal/{document}/archive', [LegalDocumentController::class, 'archiveIndex'])
    ->where('document', '[a-z-]+')
    ->name('legal.archive.index');
Route::get('/legal/{document}/archive/{revision}', [LegalDocumentController::class, 'archiveRevision'])
    ->where('document', '[a-z-]+')
    ->where('revision', '[0-9]{4}-[0-9]{2}-[0-9]{2}')
    ->name('legal.archive.revision');
