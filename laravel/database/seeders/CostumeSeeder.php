<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Costume;

class CostumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $costumes = [
            ['name' => 'hoge', 'req_lv' => 10, 'rarity_id' => 1],
            ['name' => 'piyo', 'req_lv' => 20, 'rarity_id' => 1],
            ['name' => 'fuga', 'req_lv' => 10, 'rarity_id' => 2],
        ];

        foreach($costumes as $costume){
            Costume::create([
                'costume_name' => $costume['name'],
                'req_lv' => $costume['req_lv'],
                'rarity_id' => $costume['rarity_id'],
            ]);
        }
    }
}
