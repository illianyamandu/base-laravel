<?php

use App\Http\Controllers\Api\GroupApiController;
use App\Models\Permissions\Group;
use Illuminate\Http\Request;
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
            Route::get('/create', [$controller, 'create'])->name($name . 'api.create');
            Route::post('/', [$controller, 'store'])->name($name . 'api.store');
            Route::get('/{id}', [$controller, 'show'])->name($name . 'api.show');
            Route::get('/{id}/edit', [$controller, 'edit'])->name($name . 'api.edit');
            Route::put('/{id}', [$controller, 'update'])->name($name . 'api.update');
            Route::delete('/{id}', [$controller, 'destroy'])->name($name . 'api.destroy');

            if (!is_null($additionalRoutes)) {
                $additionalRoutes();
            }
        });
    }
}

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::prefix('groups')->group(function () {
        Route::post('/', [GroupApiController::class, "store"])->name('groups.api.store');
        Route::put('/{group_id}', [GroupApiController::class, 'edit'])->name('groups.api.edit');
        Route::delete('/{group_id}', [GroupApiController::class, 'destroy'])->name('groups.api.destroy');
    });
});
