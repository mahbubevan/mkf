<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    const PRESENT = 1;
    const ABSENT = 0;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
