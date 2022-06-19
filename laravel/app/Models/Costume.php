<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rarity;

class Costume extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function clatter()
    {
        $rarities = Rarity::orderBy("rate", "asc")->get();
        $random = random_int(1, 100);
        // $random = random_int(1, ($rarities->sum("rate") * 100));

        $sum = 0;
        foreach ($rarities as $key => $rarity) {
            $per = $rarity->rate * 100;
            $sum = $sum + $per;
            if ($random < $sum) {
                // return $rarity->costumes()->get();
                return $rarity
                    ->costumes()
                    ->inRandomOrder()
                    ->first();
                break;
            }
        }

        return ["earn_exp" => config("app.clatter_earn_exp", 10)];
    }
}
