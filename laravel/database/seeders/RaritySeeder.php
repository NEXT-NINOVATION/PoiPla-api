<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rarity;

class RaritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Rarity::create([
            "rarity" => 1,
            "rate" => 0.25,
        ]);
        Rarity::create([
            "rarity" => 2,
            "rate" => 0.2,
        ]);
        Rarity::create([
            "rarity" => 3,
            "rate" => 0.15,
        ]);
        Rarity::create([
            "rarity" => 4,
            "rate" => 0.1,
        ]);
        Rarity::create([
            "rarity" => 5,
            "rate" => 0.05,
        ]);
    }
}
