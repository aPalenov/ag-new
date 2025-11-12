<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::prefix('pages')->group(function () {
    // Catch-all page route, e.g. /api/pages, /api/pages/about, /api/pages/services/web
    Route::get('/{any?}', [PageController::class, 'show'])
        ->where('any', '.*')
        ->name('api.pages.show');
});
