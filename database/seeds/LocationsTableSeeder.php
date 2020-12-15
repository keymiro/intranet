<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Location;
class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name'=>'Sitemas',
            'description'=>'',

        ]);
        DB::table('locations')->insert([
            'name'=>'Cartera',
            'description'=>'',

        ]);
        DB::table('locations')->insert([
            'name'=>'Contabilidad',
            'description'=>'',

        ]);
        DB::table('locations')->insert([
            'name'=>'Facturación',
            'description'=>'',

        ]);
    }
}
