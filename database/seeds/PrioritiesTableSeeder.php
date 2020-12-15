<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Priority;
class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            'name'=>'baja',
            'description'=>'',

        ]);
        DB::table('priorities')->insert([
            'name'=>'Media',
            'description'=>'',

        ]);
        DB::table('priorities')->insert([
            'name'=>'Normal',
            'description'=>'',

        ]);
        DB::table('priorities')->insert([
            'name'=>'Alta',
            'description'=>'',

        ]);
        DB::table('priorities')->insert([
            'name'=>'Primordial',
            'description'=>'',

        ]);
    }
}
