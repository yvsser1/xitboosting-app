<?php

use Illuminate\Database\Seeder;

class QueuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queues = [
            [
                'name' => 'Flex Summoners Rift (5v5)'
            ],
            [
                'name' => 'Solo/Duo (5v5)'
            ],
            [
                'name' => 'Flex Twisted Treeline (3v3)'
            ]
        ];

        DB::table('queues')->insert($queues);
    }
}
