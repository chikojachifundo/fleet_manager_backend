<?php

namespace App\Http\Controllers;

use App\Exports\DriverTemplateExport;
use App\Exports\VehicleTemplateExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadTemplateController extends Controller
{
    public function downloadVehicleTemplate(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new VehicleTemplateExport, 'Vehicle_template.xlsx');
    }

    public function downloadDriversTemplate(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new DriverTemplateExport, 'Drivers_Template.xlsx');
    }
}
