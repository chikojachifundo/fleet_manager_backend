<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function vehicleDocumentation(Request $request, Vehicle $vehicle)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $media = $vehicle
            ->addMediaFromRequest('file')
            ->usingName($request->category)
            ->withCustomProperties([
                'category' => $request->category
            ])
            ->toMediaCollection('vehicle_documents');

        return response()->json([
            'message' => 'Documentation uploaded successfully',
            'media' => $media
        ]);
    }
}
