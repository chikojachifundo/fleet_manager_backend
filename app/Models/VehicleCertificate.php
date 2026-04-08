<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCertificate extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleCertificateFactory> */
    use HasFactory;

    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
