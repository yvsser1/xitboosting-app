<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photos = [
            [
                'name' => 'Iron_4.png'
            ],
            [
                'name' => 'Iron_3.png'
            ],
            [
                'name' => 'Iron_2.png'
            ],
            [
                'name' => 'Iron_1.png'
            ],
            [
                'name' => 'Bronze_4.png'
            ],
            [
                'name' => 'Bronze_3.png'
            ],
            [
                'name' => 'Bronze_2.png'
            ],
            [
                'name' => 'Bronze_1.png'
            ],
            [
                'name' => 'Silver_4.png'
            ],
            [
                'name' => 'Silver_3.png'
            ],
            [
                'name' => 'Silver_2.png'
            ],
            [
                'name' => 'Silver_1.png'
            ],
            [
                'name' => 'Gold_4.png'
            ],
            [
                'name' => 'Gold_3.png'
            ],
            [
                'name' => 'Gold_2.png'
            ],
            [
                'name' => 'Gold_1.png'
            ],
            [
                'name' => 'Platinum_4.png'
            ],
            [
                'name' => 'Platinum_3.png'
            ],
            [
                'name' => 'Platinum_2.png'
            ],
            [
                'name' => 'Platinum_1.png'
            ],
            [
                'name' => 'Diamond_4.png'
            ],
            [
                'name' => 'Diamond_3.png'
            ],
            [
                'name' => 'Diamond_2.png'
            ],
            [
                'name' => 'Diamond_1.png'
            ],
            [
                'name' => 'Master_4.png'
            ],
            [
                'name' => 'Master_3.png'
            ],
            [
                'name' => 'Master_2.png'
            ],
            [
                'name' => 'Master_1.png'
            ]
        ];

        DB::table('photos')->insert($photos);
    }
}
