<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Middleware\HandleApiSharedPageData;

Route::prefix('pages')->group(function () {
    // Catch-all page route, e.g. /api/pages, /api/pages/about, /api/pages/services/web
    Route::get('/{any?}', [PageController::class, 'show'])
        ->middleware(HandleApiSharedPageData::class)
        ->where('any', '.*')
        ->name('api.pages.show');
});

Route::get('/api/dynamic-phone', function () {
    return response()->json([
        'phone' => '74957377272',
        'type' => 'dynamic',
    ]);
});
