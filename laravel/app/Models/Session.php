<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['dust_box_id', 'user_id', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
