<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DustBox;
use Illuminate\Support\Str;

class DustBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dust_boxes = [
            ['dust_box_adr' => 'koko', 'token' => 'hoge'],
            ['dust_box_adr' => 'soko', 'token' => Str::uuid()],
        ];

        foreach($dust_boxes as $dust_box){
            DustBox::create([
                'dust_box_adr' => $dust_box['dust_box_adr'],
                'token' => $dust_box['token'],
            ]);
        }
    }
}
