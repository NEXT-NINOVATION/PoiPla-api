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
            [
                "name" => "たこすけ",
                "type" => "タコ",
                "description" => "説明",
                "image" => "octopus",
                "req_lv" => 1,
                "point" => 100,
                "rarity_id" => 1,
            ],
            [
                "name" => "ミッちゃん",
                "type" => "クラゲ",
                "description" =>
                    "スーのことがだいすきなミズクラゲ。いつもはおとなしいけれど、 おこったらスーをビリビリさせちゃうぞ！",
                "image" => "jellyfish",
                "req_lv" => 3,
                "point" => 120,
                "rarity_id" => 3,
            ],
            [
                "name" => "ララ",
                "type" => "クジラ",
                "description" => "説明",
                "image" => "whale",
                "req_lv" => 50,
                "point" => 1000,
                "rarity_id" => 5,
            ],
            [
                "name" => "かめきち",
                "type" => "かめ",
                "description" =>
                    "スーにおよぐことをおしえた、スーのむかしからのおともだち。きれいなうみで、のびのびとおよぐのがだいすき！",
                "image" => "turtle",
                "req_lv" => 50,
                "point" => 50,
                "rarity_id" => 5,
            ],
            [
                "name" => "さめこ",
                "type" => "サメ",
                "description" => "説明",
                "image" => "shark",
                "req_lv" => 50,
                "point" => 1200,
                "rarity_id" => 5,
            ],
        ];

        foreach ($costumes as $costume) {
            Costume::create([
                "costume_name" => $costume["name"],
                "animal_type" => $costume["type"],
                "image" => $costume["image"],
                "req_lv" => $costume["req_lv"],
                "rarity_id" => $costume["rarity_id"],
            ]);
        }
    }
}
