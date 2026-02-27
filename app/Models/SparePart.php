<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    /** @use HasFactory<\Database\Factories\SparePartFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['formatted_value','formatted_purchase_date','formatted_expiry_date'];

    public function code()
    {
        return $this->belongsTo(SparePartCode::class, 'spare_part_code_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getFormattedValueAttribute(): string
    {
        return "MK ".number_format($this->attributes['value'], 2);
    }

    public function getFormattedPurchaseDateAttribute(): ?string
    {
        if (!isset($this->attributes['purchase_date'])) {
            return null;
        }

        return Carbon::parse($this->attributes['purchase_date'])->format('d-M-Y');
    }

    public function getFormattedExpiryDateAttribute(): ?string
    {
        if (!isset($this->attributes['expiry_date'])) {
            return null;
        }

        return Carbon::parse($this->attributes['expiry_date'])->format('d-M-Y');
    }

}
