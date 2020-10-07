<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call([
			UsersTableSeeder::class,
            AboutsTableSeeder::class,
            LeaguesTableSeeder::class,
            PhotosTableSeeder::class,
            DivisionsTableSeeder::class,
            ServersTableSeeder::class,
            QueuesTableSeeder::class
		]);
    }
}
