<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AlbumSeeder::class,
            ArtistSeeder::class,
            GenreSeeder::class,
            RolSeeder::class,
            RecordSeeder::class,
            UserSeeder::class
        ]);
    }
}
