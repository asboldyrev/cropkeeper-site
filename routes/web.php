<?php

use App\Http\Controllers\LegalDocumentController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('home');

Route::get('/sitemap.xml', function () {
    $canonicalBaseUrl = rtrim((string) config('app.url'), '/');

    $urls = [
        $canonicalBaseUrl . '/',
        $canonicalBaseUrl . '/agreement',
        $canonicalBaseUrl . '/offer',
        $canonicalBaseUrl . '/personal-data',
        $canonicalBaseUrl . '/cookies',
    ];

    $entries = collect($urls)
        ->map(fn(string $url) => sprintf(
            "    <url>\n        <loc>%s</loc>\n    </url>",
            htmlspecialchars($url, ENT_XML1 | ENT_QUOTES, 'UTF-8'),
        ))
        ->implode("\n");

    $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
{$entries}
</urlset>
XML;

    return response($xml, 200)
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

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
