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
           'rarity' => 0,
           'rate' => 7.0,
        ]);
        Rarity::create([
            'rarity' => 5,
            'rate' => 3.0,
        ]);
    }
}
