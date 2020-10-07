<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->insert([
            'name' => 'The Future of Brand Name',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam iste, officia totam deserunt, delectus quasi similique necessitatibus ex nesciunt doloribus mollitia, quas, error! Labore doloribus ex praesentium, perferendis natus a.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam iste, officia totam deserunt, delectus quasi similique necessitatibus ex nesciunt doloribus mollitia, quas, error! Labore doloribus ex praesentium, perferendis natus a.'
        ]);
    }
}
