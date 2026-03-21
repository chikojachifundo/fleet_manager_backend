<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LubricantTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\LubricantTransactionFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['formatted_date'];

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
}
