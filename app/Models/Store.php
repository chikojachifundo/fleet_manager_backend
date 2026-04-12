<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Store extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\StoreFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
}
