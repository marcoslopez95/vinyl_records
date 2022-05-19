<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('albums')->insertGetId([
            'name' => 'Vacaciones Felices'
        ]);

        DB::table('albums')->insertGetId([
            'name' => 'Navidad, Navidad'
        ]);
    }
}
