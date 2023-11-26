<?php

use App\Http\Controllers\Web\{GroupAdminController, UserAdminController};
use App\Http\Controllers\{Controller, ProfileController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

if (!function_exists('buildStandardWebRoutes')) {
    /**
     * @param string $name
     * @param Controller $controller
     * @param callable|null $additionalRoutes
     */
    function buildStandardWebRoutes($name, $controller, $additionalRoutes = null): void
    {
        Route::prefix($name)->group(function () use ($name, $controller, $additionalRoutes) {
            Route::get('/', [$controller, 'index'])->name($name . '.index');
            Route::get('/create', [$controller, 'create'])->name($name . '.create');
            Route::get('/{id}', [$controller, 'show'])->name($name . '.show');
            Route::get('/{id}/edit', [$controller, 'edit'])->name($name . '.edit');

            if (!is_null($additionalRoutes)) {
                $additionalRoutes();
            }
        });
    }
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -----------------------------------------------------------------------------
    // Admin Dashboard routes
    // -----------------------------------------------------------------------------
    Route::prefix('/admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/2', function () {
            return view('admin.main-section');
        })->name('admin.main-section');

        // -----------------------------------------------------------------------------
        // Groups routes
        // -----------------------------------------------------------------------------
        Route::prefix('/groups')->group(function () {
            Route::get('/', [GroupAdminController::class, 'index'])->name('groups.index');
        });

        // -----------------------------------------------------------------------------
        // Users routes
        // -----------------------------------------------------------------------------
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserAdminController::class, 'index'])->name('users.index');
        });
    });
});

require __DIR__ . '/auth.php';
