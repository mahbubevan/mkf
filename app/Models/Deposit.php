<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    const PENDING = 0;
    const SUCCESS = 1;
    const CANCEL = 2;
}
