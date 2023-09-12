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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    Route::post('/group', [GroupApiController::class, "store"])->name('groups.api.store');
    Route::put('/{group_id}', [GroupApiController::class, 'edit'])->name('groups.api.edit');
    Route::delete('/{group_id}', [GroupApiController::class, 'destroy'])->name('groups.api.destroy');
});
