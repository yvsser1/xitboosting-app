<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaguesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leagues = [
            [
                'name' => 'Iron'
            ],
            [
                'name' => 'Bronze'
            ],
            [
                'name' => 'Silver'
            ],
            [
                'name' => 'Gold'
            ],
            [
                'name' => 'Platinum'
            ],
            [
                'name' => 'Diamond'
            ],
            [
                'name' => 'Master'
            ]
        ];

        DB::table('leagues')->insert($leagues);
    }
}
