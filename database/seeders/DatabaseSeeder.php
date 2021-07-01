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
		Storage::makeDirectory('designs');
		Storage::makeDirectory('briefs');
		Storage::makeDirectory('backgrounds');
		Storage::delete(Storage::allFiles('logos'));
		Storage::delete(Storage::allFiles('designs'));
		Storage::delete(Storage::allFiles('briefs'));
		Storage::delete(Storage::allFiles('backgrounds'));

        $this->call([
        	UserSeeder::class,
			BusinessFieldSeeder::class,
			BusinessSeeder::class,
		]);
    }
}
