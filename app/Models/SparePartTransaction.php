<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SparePartTransaction extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\SparePartTransactionFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function sparePart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SparePart::class);
    }
}
