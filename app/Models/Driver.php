<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Driver extends Model implements HasMedia, Auditable
{
    /** @use HasFactory<\Database\Factories\DriverFactory> */
    use HasFactory, InteractsWithMedia;
    use \OwenIt\Auditing\Auditable;
    protected  $guarded = [];
    protected $appends = ['full_name','age','actual_birthdate'];
    protected $casts = [
        'birthdate' => 'date',
    ];

    public function getFullNameAttribute(): string
    {
        return $this->firstname." ".$this->surname;
    }

    public function getAgeAttribute()
    {
        return $this->birthdate?->age;
    }

    public function getActualBirthdateAttribute(): string
    {
        return Carbon::parse($this->birthdate)->format('Y-m-d');
    }
}
