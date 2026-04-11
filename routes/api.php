<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ApproveConsignmentController;
use App\Http\Controllers\ApproveIncomingSparePartRequisition;
use App\Http\Controllers\BatchUploadController;
use App\Http\Controllers\CancelTyreMovementController;
use App\Http\Controllers\CancelVehicleCertificateController;
use App\Http\Controllers\ChangeUserPasswordController;
use App\Http\Controllers\ConsignmentController;
use App\Http\Controllers\ConsignmentRouteController;
use App\Http\Controllers\Dashboards\AdminDashboardController;
use App\Http\Controllers\Dashboards\LubricantsDashboardController;
use App\Http\Controllers\DeleteMediaController;
use App\Http\Controllers\DownloadTemplateController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpenseActionController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\FuelTransactionActionController;
use App\Http\Controllers\FuelTransactionController;
use App\Http\Controllers\IncomingSparePartRequisitionController;
use App\Http\Controllers\LubricantController;
use App\Http\Controllers\LubricantTransactionActionController;
use App\Http\Controllers\LubricantTransactionController;
use App\Http\Controllers\RejectConsignmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\ConsignmentsReportController;
use App\Http\Controllers\Reports\ExpensesReportController;
use App\Http\Controllers\Reports\VehicleCertificateReportController;
use App\Http\Controllers\SparePartCodeController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StoresDashboardController;
use App\Http\Controllers\TyreController;
use App\Http\Controllers\TyreMovementController;
use App\Http\Controllers\TyreRepairController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleCertificateController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleServiceActionController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('stores/dashboard', StoresDashboardController::class);
    Route::post('spares/requisitions/approve', ApproveIncomingSparePartRequisition::class)->name('spares.requisitions.approve');

    Route::resource('sparePartCodes', SparePartCodeController::class);
    Route::resource('spareParts', SparePartController::class);
    Route::resource('incomingSparePartsRequisition', IncomingSparePartRequisitionController::class);

    Route::resource('tyres', TyreController::class);
    Route::get('tyr/template', [DownloadTemplateController::class, 'downloadTyresTemplate'])->name('tyres.template');
    Route::post('tyr/batch/upload', [BatchUploadController::class, 'tyresBatchUpload'])->name('tyres.batch.upload');

    Route::resource('tyre/movements', TyreMovementController::class);
    Route::post('tyre/movements/{tyreMovement}/cancel', CancelTyreMovementController::class);

    Route::post('tyres/repairs/{tyre}/repair', [TyreRepairController::class, 'sendToRepair'])->name('tyres.repair.send');
    Route::post('tyres/repairs/{tyre}/accept', [TyreRepairController::class, 'acceptFromRepair'])->name('tyres.repair.accept');
    Route::post('tyres/repairs/{tyre}/scrap', [TyreRepairController::class, 'markScrap'])->name('tyres.repair.markScrap');


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
    Route::post('consignments/{consignment}/approve', ApproveConsignmentController::class);
    Route::post('consignments/{consignment}/reject', RejectConsignmentController::class);

    Route::get('/dashboard/lubricants', [LubricantsDashboardController::class, 'counters'])->name('dashboard.lubricants.counters');
    Route::get('/dashboard/administrator', [AdminDashboardController::class, 'getStatistics'])->name('dashboard.administrator.statistics');

    Route::resource('lubricants', LubricantController::class);
    Route::resource('lubricants/transactions', LubricantTransactionController::class);
    Route::patch('lubricants/transactions/{lubricantTransaction}/process', [LubricantTransactionActionController::class, 'approve'])->name('lubricants.transactions.approve');

    Route::resource('vehicle/certificates', VehicleCertificateController::class);
    Route::get('certificates/{vehicleCertificate}/cancel', CancelVehicleCertificateController::class);

    Route::resource('expenses', ExpenseController::class);
    Route::post('expenses/{expense}/approve', [ExpenseActionController::class, 'approve'])->name('expenses.actions.approve');
    Route::post('expenses/{expense}/reject', [ExpenseActionController::class, 'reject'])->name('expenses.actions.reject');

    Route::resource('vehicles-servicing', VehicleServiceController::class)->parameters([
        'vehicles-servicing' => 'vehicleService'
    ]);
    Route::post('/vehicles/servicing/{vehicleService}/approve', [VehicleServiceActionController::class, 'approve']);
    Route::post('/vehicles/servicing/{vehicleService}/reject', [VehicleServiceActionController::class, 'reject']);


    Route::delete('documents/{media}/delete', DeleteMediaController::class)->name('documents.delete');


    Route::get('reports/consignments', [ConsignmentsReportController::class, 'generate'])->name('reports.consignments');
    Route::get('reports/consignments/export/excel', [ConsignmentsReportController::class, 'exportExcel'])->name('reports.consignments.export.excel');
    Route::get('reports/consignments/export/pdf', [ConsignmentsReportController::class, 'exportPDF'])->name('reports.consignments.export.pdf');

    Route::get('reports/vehicle/certificates', [VehicleCertificateReportController::class, 'vehicleCertificates'])->name('reports.vehicle.certificates');
    Route::get('reports/vehicle/certificates/export', [VehicleCertificateReportController::class, 'exportVehicleCertificates'])->name('reports.vehicle.certificates.export');

    Route::get('reports/expenses', [ExpensesReportController::class, 'index'])->name('reports.expenses');
    Route::get('reports/expenses/export', [ExpensesReportController::class, 'export'])->name('reports.expenses.export');
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/change-password', ChangeUserPasswordController::class)->name('users.change-password');

    Route::post('/account/password/change', [AccountSettingsController::class, 'changePassword'])->name('account.password.change');
});
