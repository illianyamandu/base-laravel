<?php

use App\Models\Permission\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    Route::post('/group', function () {
        Group::create([
            'name'        => request()->name,
            'slug'        => Str::slug(request()->name, '-'),
            'description' => request()->description,
        ]);

        return redirect()->route('groups.index');
    })->name('groups.api.store');
});
