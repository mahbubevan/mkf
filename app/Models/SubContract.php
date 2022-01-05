<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContract extends Model
{
    use HasFactory;

    const PENDING = 0;
    const APPROVED  =1;
    const CANCELED = 2;

    const CUTTING = 0;
    const SEWING = 1;
    const WASHING = 2;
    const PACKING = 3;
    const CTN = 4;
    const DELIVERED = 5;

    const UNPAID = 0;
    const PAID = 1;
    const PARTPAID = 2;
}
