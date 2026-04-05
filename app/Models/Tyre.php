<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tyre extends Model
{
    /** @use HasFactory<\Database\Factories\TyreFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['current_allocation'];

    public function movements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TyreMovement::class);
    }

    public function getCurrentAllocationAttribute()
    {
        return TyreMovement::where('tyre_id', $this->attributes['id'])->where('status','active')->latest()->first()?->load('vehicle');
    }
}
