<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actors')->insert(
            [
                ['id' => 1, 'name' => '石原夏織'],
                ['id' => 2, 'name' => '内田真礼'],
                ['id' => 3, 'name' => '井口裕香'],
                ['id' => 4, 'name' => '東山奈央'],
                ['id' => 5, 'name' => '小原好美'],
                ['id' => 6, 'name' => '中島由貴'],
                ['id' => 7, 'name' => '岡咲美保'],
                ['id' => 8, 'name' => '羊宮妃那'],
                ['id' => 9, 'name' => '日高里菜'],
                ['id' => 10, 'name' => '加隈亜衣'],
                ['id' => 11, 'name' => '高垣彩陽'],
                ['id' => 12, 'name' => '鬼頭明里'],
                ['id' => 13, 'name' => '内山夕実'],
                ['id' => 14, 'name' => '種田梨沙'],
                ['id' => 15, 'name' => '水野朔'],
                ['id' => 16, 'name' => '石見舞菜香'],
                ['id' => 17, 'name' => '長谷川育美'],
                ['id' => 18, 'name' => '豊崎愛生'],
                ['id' => 19, 'name' => '花澤香菜'],
                ['id' => 20, 'name' => '上田麗奈'],
                ['id' => 21, 'name' => '竹達彩奈'],
                ['id' => 22, 'name' => '沼倉愛美'],
                ['id' => 23, 'name' => '悠木碧'],
                ['id' => 24, 'name' => '石上静香'],
                ['id' => 25, 'name' => 'Lynn'],
                ['id' => 26, 'name' => '早見沙織']
            ]
        );
    }
}
