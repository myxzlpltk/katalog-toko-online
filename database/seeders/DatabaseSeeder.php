<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Review;
use App\Models\Shop;
use App\Models\User;
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
        Storage::makeDirectory('photos');
        Storage::delete(Storage::allFiles('logos'));
        Storage::delete(Storage::allFiles('photos'));

        User::factory()->create(['email' => 'admin@gmail.com']);

        Category::query()->create(['name' => 'Tradisional']);
        Category::query()->create(['name' => 'Oleh-Oleh']);

        Shop::factory(10)
            ->has(Review::factory()->count(15))
            ->has(Photo::factory()->count(10))
            ->create();
    }
}
