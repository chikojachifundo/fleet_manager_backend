<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ApproveIncomingSparePartRequisition;
use App\Http\Controllers\BatchUploadController;
use App\Http\Controllers\ChangeUserPasswordController;
use App\Http\Controllers\ConsignmentController;
use App\Http\Controllers\ConsignmentRouteController;
use App\Http\Controllers\DeleteMediaController;
use App\Http\Controllers\DownloadTemplateController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\FuelTransactionActionController;
use App\Http\Controllers\FuelTransactionController;
use App\Http\Controllers\IncomingSparePartRequisitionController;
use App\Http\Controllers\LubricantController;
use App\Http\Controllers\LubricantTransactionActionController;
use App\Http\Controllers\LubricantTransactionController;
use App\Http\Controllers\SparePartCodeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StoresDashboardController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');;


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

Route::resource('fuels', FuelController::class);
Route::resource('fuel/transactions', FuelTransactionController::class);
Route::patch('fuel/transactions/{fuelTransaction}/process', [FuelTransactionActionController::class, 'process']);

Route::resource('consignment/routes', ConsignmentRouteController::class);

Route::resource('consignments', ConsignmentController::class);

Route::resource('lubricants', LubricantController::class);
Route::resource('lubricants/transactions', LubricantTransactionController::class);
Route::patch('lubricants/transactions/{lubricantTransaction}/process', [LubricantTransactionActionController::class, 'approve'])->name('lubricants.transactions.approve');


Route::resource('vehicles-servicing', VehicleServiceController::class)->parameters([
    'vehicles-servicing' => 'vehicleService'
]);


Route::delete('documents/{media}/delete', DeleteMediaController::class)->name('documents.delete');


Route::resource('users', UserController::class);
Route::post('/users/{user}/change-password', ChangeUserPasswordController::class)->name('users.change-password');
