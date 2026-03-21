<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lubricant extends Model
{
    /** @use HasFactory<\Database\Factories\LubricantFactory> */
    use HasFactory;

    protected $guarded = [];

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LubricantTransaction::class);
    }
}
