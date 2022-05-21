<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Record;
use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Record::factory(10)->create();

        $records = Record::all();
        $genres = Genre::all();
        foreach($records as $record){
            $cantidad = rand(1,3);
            $attch = $genres->random($cantidad);
            $record->genres()->attach($attch->modelKeys());
        }
    }
}
