<?php

use App\Http\Controllers\Api\{Auth, GroupApiController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */
if (!function_exists('buildStandardAPIRoutes')) {
    /**
     * @param string $name
     * @param Controller $controller
     * @param callable|null $additionalRoutes
     */
    function buildStandardAPIRoutes($name, $controller, $additionalRoutes = null): void
    {
        Route::prefix($name)->group(function () use ($name, $controller, $additionalRoutes) {
            Route::get('/', [$controller, 'list'])->name($name . 'api.list');
            Route::get('/{id}', [$controller, 'detailed'])->name($name . 'api.detailed');
            Route::post('/', [$controller, 'store'])->name($name . 'api.store');
            Route::put('/{id}', [$controller, 'update'])->name($name . 'api.update');
            Route::delete('/{id}', [$controller, 'destroy'])->name($name . 'api.destroy');
            Route::delete('/archive/{id}', [$controller, 'archive'])->name($name . 'api.archive');

            if (!is_null($additionalRoutes)) {
                $additionalRoutes();
            }
        });
    }
}

// -----------------------------------------------------------------------------
// Public routes
// -----------------------------------------------------------------------------
Route::prefix('auth')->group(function () {
    Route::post('login', Auth\LoginApiController::class)->name('auth.api.login');
});

// -----------------------------------------------------------------------------
// Authenticated routes
// -----------------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::delete('/logout', Auth\LogoutApiController::class)->name('auth.api.logout');
    });

    // -----------------------------------------------------------------------------
    // Groups routes
    // -----------------------------------------------------------------------------
    buildStandardAPIRoutes('groups', GroupApiController::class);
});
