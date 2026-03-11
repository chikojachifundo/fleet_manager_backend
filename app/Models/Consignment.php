<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    /** @use HasFactory<\Database\Factories\ConsignmentFactory> */
    use HasFactory;

    protected  $guarded = [];
    protected $appends = ['formatted_date'];

    public function driver(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }

    public function consignmentRoute(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ConsignmentRoute::class, 'id', 'consignment_route_id');
    }

    public function getFOrmattedDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->translatedFormat('d F Y');
    }
}
