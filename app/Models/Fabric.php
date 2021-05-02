<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    use HasFactory;

    const AVAIL = 1;
    const UNAVAIL = 0;

    public function production()
    {
        return $this->hasOne(Production::class, 'fabric_id');
    }
}
