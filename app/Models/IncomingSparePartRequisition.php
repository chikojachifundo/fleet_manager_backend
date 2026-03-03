<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingSparePartRequisition extends Model
{
    /** @use HasFactory<\Database\Factories\IncomingSparePartRequisitionFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['formatted_date', 'formatted_value'];

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class);
    }

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->attributes['date'])->format('d-M-Y');
    }

    public function getFormattedValueAttribute()
    {
        return "MK " . number_format($this->attributes['value'], 2);
    }
}
