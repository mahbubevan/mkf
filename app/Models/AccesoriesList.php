<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesoriesList extends Model
{
    use HasFactory;

    public function accessories()
    {
        return $this->hasMany(Accesories::class,'accesories_list');
    }
}
