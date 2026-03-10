<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Driver extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\DriverFactory> */
    use HasFactory, InteractsWithMedia;
    protected  $guarded = [];
}
