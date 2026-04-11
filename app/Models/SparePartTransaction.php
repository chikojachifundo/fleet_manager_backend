<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\SparePartTransactionFactory> */
    use HasFactory;

    protected $guarded = [];

    public function sparePart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SparePart::class);
    }
}
