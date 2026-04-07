<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\FuelTransactionFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['formatted_date','total_cost'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->attributes['date'])->format('d M Y');
    }

    public function getTotalCostAttribute(): float|int
    {
        return $this->attributes['cost_per_litre'] * $this->attributes['quantity'];
    }
}
