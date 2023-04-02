<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PersonalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personalities')->insert([
            ["actors_id" => 1, "programs_id" => 1],
            ["actors_id" => 2, "programs_id" => 2],
            ["actors_id" => 2, "programs_id" => 3],
            ["actors_id" => 3, "programs_id" => 4],
            ["actors_id" => 4, "programs_id" => 5],
            ["actors_id" => 4, "programs_id" => 6],
            ["actors_id" => 5, "programs_id" => 7],
            ["actors_id" => 5, "programs_id" => 8],
            ["actors_id" => 5, "programs_id" => 9],
            ["actors_id" => 5, "programs_id" => 10],
            ["actors_id" => 6, "programs_id" => 11],
            ["actors_id" => 7, "programs_id" => 11],
            ["actors_id" => 8, "programs_id" => 12],
            ["actors_id" => 9, "programs_id" => 13],
            ["actors_id" => 10, "programs_id" => 13],
            ["actors_id" => 11, "programs_id" => 14],
            ["actors_id" => 12, "programs_id" => 15],
            ["actors_id" => 13, "programs_id" => 16],
            ["actors_id" => 14, "programs_id" => 16],
            ["actors_id" => 15, "programs_id" => 17],
            ["actors_id" => 16, "programs_id" => 18],
            ["actors_id" => 17, "programs_id" => 18],
            ["actors_id" => 18, "programs_id" => 19],
            ["actors_id" => 18, "programs_id" => 20],
            ["actors_id" => 19, "programs_id" => 21],
            ["actors_id" => 19, "programs_id" => 22],
            ["actors_id" => 20, "programs_id" => 23],
            ["actors_id" => 20, "programs_id" => 24],
            ["actors_id" => 21, "programs_id" => 25],
            ["actors_id" => 22, "programs_id" => 25],
            ["actors_id" => 23, "programs_id" => 26],
            ["actors_id" => 23, "programs_id" => 27],
            ["actors_id" => 24, "programs_id" => 9],
            ["actors_id" => 25, "programs_id" => 28],
            ["actors_id" => 26, "programs_id" => 29]
        ]);
    }
}
