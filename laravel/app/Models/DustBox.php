<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Session;

class DustBox extends Model
{
    use HasFactory;

    protected $hidden = ["token"];

    protected $fillable = ["token", "dust_box_adr"];
    public function sessions()
    {
        return $this->hasMany(Session::class, "dust_box_id");
    }
}
