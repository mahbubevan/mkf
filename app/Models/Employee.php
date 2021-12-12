<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    const FULLTIME = 1;
    const PARTTIME = 0;

    const ACTIVE = 1;
    const INACTIVE = 0;

    public function attendences()
    {
        return $this->hasMany(Attendance::class);
    }
}
