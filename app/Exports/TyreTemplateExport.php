<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TyreTemplateExport implements WithHeadings
{

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            "Serial Number",
            "Brand",
            "Model",
            "Year Of Manufacture",
            "Size",
            "Type",
            "Thread Pattern",
            "Category",
            "Purchase Date",
            "Purchase Cost",
            "Supplier",
            "Supplier Contact"
        ];
    }
}
