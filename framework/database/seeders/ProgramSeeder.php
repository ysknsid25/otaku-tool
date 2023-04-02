<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert(
            [
                ["id" => 1, "programnm" => "石原夏織のCarry up!?【動】", "begintime" => 1900, "endtime" => 1930, "weekday" => 0],
                ["id" => 2, "programnm" => "内田真礼とおはなししません？【動】", "begintime" => 2100, "endtime" => 2130, "weekday" => 0],
                ["id" => 3, "programnm" => "内田真礼とおはなししません？【動】", "begintime" => 1600, "endtime" => 1630, "weekday" => 6],
                ["id" => 4, "programnm" => "井口裕香のむ～～～ん ⊂(　＾ω＾)⊃【動】", "begintime" => 2200, "endtime" => 2300, "weekday" => 0],
                ["id" => 5, "programnm" => "東山奈央のラジオ＠リビング", "begintime" => 2300, "endtime" => 2330, "weekday" => 0],
                ["id" => 6, "programnm" => "東山奈央のラジオ＠リビング", "begintime" => 1300, "endtime" => 1330, "weekday" => 5],
                ["id" => 7, "programnm" => "小原好美のココロおきなく", "begintime" => 1730, "endtime" => 1800, "weekday" => 1],
                ["id" => 8, "programnm" => "小原好美のココロおきなく", "begintime" => 1100, "endtime" => 1130, "weekday" => 5],
                ["id" => 9, "programnm" => "小原好美と石上静香の グイグイくるラジオ。", "begintime" => 1830, "endtime" => 1900, "weekday" => 5],
                ["id" => 10, "programnm" => "小原好美のココロおきなく", "begintime" => 2000, "endtime" => 2030, "weekday" => 5],
                ["id" => 11, "programnm" => "中島由貴・岡咲美保 あうとスタンド！！【動】", "begintime" => 2500, "endtime" => 2530, "weekday" => 5],
                ["id" => 12, "programnm" => "A＆G NEXT STEP HOOOOPE!【動】", "begintime" => 2000, "endtime" => 2100, "weekday" => 1],
                ["id" => 13, "programnm" => "ひだかくま【動】", "begintime" => 2300, "endtime" => 2330, "weekday" => 1],
                ["id" => 14, "programnm" => "高垣彩陽のあしたも晴レルヤ", "begintime" => 2530, "endtime" => 2600, "weekday" => 1],
                ["id" => 15, "programnm" => "鬼頭明里のsmiley pop", "begintime" => 1930, "endtime" => 2000, "weekday" => 2],
                ["id" => 16, "programnm" => "夕実＆梨沙のラフストーリーは突然に", "begintime" => 2100, "endtime" => 2130, "weekday" => 2],
                ["id" => 17, "programnm" => "A＆G NEXT STEP HOOOOPE!【動】", "begintime" => 2000, "endtime" => 2100, "weekday" => 3],
                ["id" => 18, "programnm" => "ワールドダイスターRADIO☆わらじ【動】", "begintime" => 2100, "endtime" => 2130, "weekday" => 3],
                ["id" => 19, "programnm" => "豊崎愛生のおかえりらじお【動】", "begintime" => 2200, "endtime" => 2300, "weekday" => 3],
                ["id" => 20, "programnm" => "豊崎愛生のおかえりらじお【動】", "begintime" => 1000, "endtime" => 1100, "weekday" => 4],
                ["id" => 21, "programnm" => "明治  presents  花澤香菜のひとりでできるかな？", "begintime" => 2300, "endtime" => 2330, "weekday" => 3],
                ["id" => 22, "programnm" => "明治  presents  花澤香菜のひとりでできるかな？", "begintime" => 1100, "endtime" => 1130, "weekday" => 4],
                ["id" => 23, "programnm" => "上田麗奈のひみつばこ", "begintime" => 2330, "endtime" => 2400, "weekday" => 3],
                ["id" => 24, "programnm" => "上田麗奈のひみつばこ", "begintime" => 1130, "endtime" => 1200, "weekday" => 4],
                ["id" => 25, "programnm" => "竹達・沼倉の初ラジ！", "begintime" => 1900, "endtime" => 1930, "weekday" => 5],
                ["id" => 26, "programnm" => "悠木碧のこしらえるラジオ", "begintime" => 1930, "endtime" => 2000, "weekday" => 5],
                ["id" => 27, "programnm" => "悠木碧のこしらえるラジオ", "begintime" => 1330, "endtime" => 1400, "weekday" => 6],
                ["id" => 28, "programnm" => "Lynnのおしゃべりんらじお【動】", "begintime" => 1000, "endtime" => 1030, "weekday" => 6],
                ["id" => 29, "programnm" => "早見沙織の ふり～すたいる♪【生】", "begintime" => 1930, "endtime" => 2000, "weekday" => 6],
            ]
        );
    }
}
