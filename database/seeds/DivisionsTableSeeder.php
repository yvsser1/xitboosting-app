<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            [
                'league_id' => '1',
                'name' => 'IV',
                'photo_id' => '1'
            ],
            [
                'league_id' => '1',
                'name' => 'III',
                'photo_id' => '2'
            ],
            [
                'league_id' => '1',
                'name' => 'II',
                'photo_id' => '3'
            ],
            [
                'league_id' => '1',
                'name' => 'I',
                'photo_id' => '4'
            ],

            [
                'league_id' => '2',
                'name' => 'IV',
                'photo_id' => '5'
            ],
            [
                'league_id' => '2',
                'name' => 'III',
                'photo_id' => '6'
            ],
            [
                'league_id' => '2',
                'name' => 'II',
                'photo_id' => '7'
            ],
            [
                'league_id' => '2',
                'name' => 'I',
                'photo_id' => '8'
            ],

            [
                'league_id' => '3',
                'name' => 'IV',
                'photo_id' => '9'
            ],
            [
                'league_id' => '3',
                'name' => 'III',
                'photo_id' => '10'
            ],
            [
                'league_id' => '3',
                'name' => 'II',
                'photo_id' => '11'
            ],
            [
                'league_id' => '3',
                'name' => 'I',
                'photo_id' => '12'
            ],

            [
                'league_id' => '4',
                'name' => 'IV',
                'photo_id' => '13'
            ],
            [
                'league_id' => '4',
                'name' => 'III',
                'photo_id' => '14'
            ],
            [
                'league_id' => '4',
                'name' => 'II',
                'photo_id' => '15'
            ],
            [
                'league_id' => '4',
                'name' => 'I',
                'photo_id' => '16'
            ],

            [
                'league_id' => '5',
                'name' => 'IV',
                'photo_id' => '17'
            ],
            [
                'league_id' => '5',
                'name' => 'III',
                'photo_id' => '18'
            ],
            [
                'league_id' => '5',
                'name' => 'II',
                'photo_id' => '19'
            ],
            [
                'league_id' => '5',
                'name' => 'I',
                'photo_id' => '20'
            ],

            [
                'league_id' => '6',
                'name' => 'IV',
                'photo_id' => '21'
            ],
            [
                'league_id' => '6',
                'name' => 'III',
                'photo_id' => '22'
            ],
            [
                'league_id' => '6',
                'name' => 'II',
                'photo_id' => '23'
            ],
            [
                'league_id' => '6',
                'name' => 'I',
                'photo_id' => '24'
            ]
        ];

        DB::table('divisions')->insert($divisions);
    }
}
