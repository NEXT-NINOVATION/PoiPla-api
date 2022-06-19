<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function costumes()
    {
        return $this->hasMany(Costume::class);
    }
}
