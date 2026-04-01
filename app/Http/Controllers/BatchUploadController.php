<?php

namespace App\Http\Controllers;

use App\Imports\DriverImport;
use App\Imports\TyreImport;
use App\Imports\VehicleImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class BatchUploadController extends Controller
{
    public function vehiclesBatchUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        DB::transaction(function () use ($request) {
            Excel::import(new VehicleImport, $request->file('file'));
        });

        return response()->json([
            'message' => 'Vehicles imported successfully'
        ]);
    }

    public function driversBatchUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        DB::transaction(function () use ($request) {
            Excel::import(new DriverImport, $request->file('file'));
        });

        return response()->json([
            'message' => 'Vehicles imported successfully'
        ]);
    }

    public function tyresBatchUpload(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);
        DB::transaction(function () use ($request) {
            Excel::import(new TyreImport, $request->file('file'));
        });
        return response()->json([
            'message' => 'Tyres imported successfully'
        ]);
    }
}
