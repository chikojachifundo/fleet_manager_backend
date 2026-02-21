<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    /** @use HasFactory<\Database\Factories\SparePartFactory> */
    use HasFactory;

    public function code()
    {
        return $this->belongsTo(SparePartCode::class,'spare_part_code_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
