<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LubricantTransaction extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\LubricantTransactionFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    protected $appends = ['formatted_date','formatted_cost'];

    public function lubricant()
    {
        return $this->belongsTo(Lubricant::class);
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->attributes['date'])->format('d M Y');
    }

    public function getFormattedCostAttribute(): string
    {
        return number_format($this->attributes['cost'], 2);
    }
}
