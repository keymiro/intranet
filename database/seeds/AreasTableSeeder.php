<?php

use Illuminate\Database\Seeder;
use App\Area;
use Illuminate\Support\Facades\DB;
class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'name'=>'Sistemas',
        ]);
        DB::table('areas')->insert([
            'name'=>'Calidad',
        ]);
        DB::table('areas')->insert([
            'name'=>'Recursos Humanos',
        ]);
        DB::table('areas')->insert([
            'name'=>'Cartera',
        ]);
    }
}
