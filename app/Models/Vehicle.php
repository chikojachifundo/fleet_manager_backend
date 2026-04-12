<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vehicle extends Model implements HasMedia , Auditable
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;
    use InteractsWithMedia;
    use \OwenIt\Auditing\Auditable;


    protected $guarded = [];
    protected $appends = ['formatted_year_of_manufacture'];

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function fuelTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FuelTransaction::class);
    }

    public function getFormattedYearOfManufactureAttribute(): string
    {
        return Carbon::parse($this->year_of_manufacture)->format('Y');
    }

    public function tyreMovements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TyreMovement::class);
    }

    public function certificates()
    {
        return $this->hasMany(VehicleCertificate::class);
    }

}
