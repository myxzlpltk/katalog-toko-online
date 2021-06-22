<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::makeDirectory('logos');
        Storage::delete(Storage::allFiles('logos'));

        $this->call([
        	UserSeeder::class,
			BusinessFieldSeeder::class,
			BusinessSeeder::class,
		]);
    }
}
