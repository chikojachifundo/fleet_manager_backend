<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    /** @use HasFactory<\Database\Factories\ConsignmentFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['formatted_date','formatted_drivers_allowance'];

    public function driver(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }

    public function horse()
    {
        return $this->hasOne(Vehicle::class, 'id', 'horse_id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function firstTrailer()
    {
        return $this->hasOne(Vehicle::class, 'id', 'first_trailer_id');
    }

    public function secondTrailer()
    {
        return $this->hasOne(Vehicle::class, 'id', 'second_trailer_id');
    }

    public function consignmentRoute(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ConsignmentRoute::class, 'id', 'consignment_route_id');
    }

    public function lubricantsTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LubricantTransaction::class, 'consignment_id', 'id');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->translatedFormat('d F Y');
    }

    public function getFormattedDriversAllowanceAttribute()
    {
        return number_format($this->attributes['drivers_allowance'], 2, '.', ',');
    }
}
