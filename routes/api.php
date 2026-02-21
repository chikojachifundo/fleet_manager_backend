<?php

use App\Http\Controllers\SparePartCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admins')->group(function () {
});


Route::resource('spares', SparePartCodeController::class);
