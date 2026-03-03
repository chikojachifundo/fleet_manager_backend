<?php

use App\Http\Controllers\ApproveIncomingSparePartRequisition;
use App\Http\Controllers\IncomingSparePartRequisitionController;
use App\Http\Controllers\SparePartCodeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StoresDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admins')->group(function () {
});

Route::get('stores/dashboard', StoresDashboardController::class );
Route::post('spares/requisitions/approve', ApproveIncomingSparePartRequisition::class)->name('spares.requisitions.approve');

Route::resource('sparePartCodes', SparePartCodeController::class);
Route::resource('spareParts', SparePartController::class);
Route::resource('incomingSparePartsRequisition', IncomingSparePartRequisitionController::class);
