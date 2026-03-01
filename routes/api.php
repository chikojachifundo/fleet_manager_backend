<?php

use App\Http\Controllers\IncomingSparePartRequisitionController;
use App\Http\Controllers\SparePartCodeController;
use App\Http\Controllers\SparePartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admins')->group(function () {
});


Route::resource('sparePartCodes', SparePartCodeController::class);
Route::resource('spareParts', SparePartController::class);
Route::resource('incomingSparePartsRequisition', IncomingSparePartRequisitionController::class);
