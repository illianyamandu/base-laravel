<?php

use App\Models\Permissions\Group;
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

    Route::put('/{group_id}', function ($group_id) {
        $group = Group::find($group_id);

        $group->update([
            'name'        => request()->name,
            'slug'        => Str::slug(request()->name, '-'),
            'description' => request()->description,
        ]);

        return redirect()->route('groups.index');
    })->name('groups.api.edit');

    Route::delete('/{group_id}', function ($group_id) {
        $group = Group::find($group_id);

        $group->delete();

        return redirect()->route('groups.index');
    })->name('groups.api.destroy');
});
