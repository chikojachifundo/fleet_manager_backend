<?php

use App\Http\Controllers\ApproveIncomingSparePartRequisition;
use App\Http\Controllers\BatchUploadController;
use App\Http\Controllers\DeleteMediaController;
use App\Http\Controllers\DownloadTemplateController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\IncomingSparePartRequisitionController;
use App\Http\Controllers\SparePartCodeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StoresDashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admins')->group(function () {
});

Route::get('stores/dashboard', StoresDashboardController::class);
Route::post('spares/requisitions/approve', ApproveIncomingSparePartRequisition::class)->name('spares.requisitions.approve');

Route::resource('sparePartCodes', SparePartCodeController::class);
Route::resource('spareParts', SparePartController::class);
Route::resource('incomingSparePartsRequisition', IncomingSparePartRequisitionController::class);

Route::post('vehicles/{vehicle}/documents/upload', [UploadController::class, 'vehicleDocumentation'])->name('vehicles.documentation.upload');
Route::get('vehicles/template', [DownloadTemplateController::class, 'downloadVehicleTemplate'])->name('vehicles.template');
Route::post('vehicles/batch/upload', [BatchUploadController::class, 'vehiclesBatchUpload'])->name('vehicles.batch.upload');
Route::resource('vehicles', VehicleController::class);


Route::post('drivers/{driver}/documents/upload', [UploadController::class, 'driverDocumentation'])->name('drivers.documentation.upload');
Route::get('drivers/template', [DownloadTemplateController::class, 'downloadDriversTemplate'])->name('drivers.template');
Route::post('drivers/batch/upload', [BatchUploadController::class, 'driversBatchUpload'])->name('drivers.batch.upload');

Route::resource('drivers', DriverController::class);

Route::delete('documents/{document}/delete', DeleteMediaController::class)->name('documents.delete');
