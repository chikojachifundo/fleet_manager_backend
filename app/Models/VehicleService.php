<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleServiceFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['formatted_date'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function consignment()
    {
        return $this->belongsTo(Consignment::class);
    }

    public function sparePartTransactions()
    {
        return $this->hasMany(SparePartTransaction::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('d F Y');
    }
}
