<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VehicleCertificate extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\VehicleCertificateFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;


    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
