<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rarity;
use App\Models\Prefecture;
use App\Models\Event;

class Costume extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $with = ["prefecture", "event", "rarityRef"];
    protected $appends = ["rarity", "buyable_flag"];

    /*
    | ガチャガチャ
    | ハズレの場合は false を返す
    */
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

        return false;
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, "pref_id");
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function rarityRef()
    {
        return $this->belongsTo(Rarity::class, "rarity_id");
    }

    public function getRarityAttribute()
    {
        return $this->rarityRef->rarity;
    }

    public function getBuyableFlagAttribute()
    {
        return (bool) $this->point;
    }
}
