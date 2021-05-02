<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    const CUTTING = 0;
    const SWING = 1;
    const WASH = 2;
    const PACKING = 3;
    const COMPLETED = 4;

    protected $casts = ['accesories_count' => 'array', 'sizes' => 'array'];

    public function fabric()
    {
        return $this->belongsTo(Fabric::class, 'fabric_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'production_code', 'code');
    }
}
