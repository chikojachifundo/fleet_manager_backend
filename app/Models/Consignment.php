<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Consignment extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\ConsignmentFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];
    protected $appends = ['formatted_date', 'formatted_drivers_allowance'];

    public function driver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function horse(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function firstTrailer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function secondTrailer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function consignmentRoute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ConsignmentRoute::class);
    }

    public function lubricantsTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LubricantTransaction::class, 'consignment_id', 'id');
    }

    public function fuelTransactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FuelTransaction::class, 'consignment_id', 'id');
    }

    public function vehicleServices()
    {
        return $this->hasMany(VehicleService::class, 'consignment_id', 'id');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->translatedFormat('d F Y');
    }

    public function getFormattedDriversAllowanceAttribute()
    {
        return number_format($this->attributes['drivers_allowance'], 2, '.', ',');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'consignment_id', 'id');
    }


}
