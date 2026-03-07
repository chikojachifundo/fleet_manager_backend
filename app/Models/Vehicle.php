<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['formatted_year_of_manufacture'];

    public function getFormattedYearOfManufactureAttribute(): string
    {
        return Carbon::parse($this->year_of_manufacture)->format('Y');
    }
}
