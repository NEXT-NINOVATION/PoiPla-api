<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Costume;

class ClatterResult extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "costume_id", "session_id", "earn_exp"];

    protected $appends = ["type"];

    protected $with = ["costume"];

    public function getTypeAttribute()
    {
        if ($this->costume_id) {
            return "constume";
        } else {
            return "exp";
        }
    }

    public function costume()
    {
        return $this->belongsTo(Costume::class);
    }
}
