<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\FuelTransactionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }
}
