<?php

use Illuminate\Database\Seeder;
use App\Jobtitle;
use Illuminate\Support\Facades\DB;
class JobtitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobtitles')->insert([
            'title'=>'Analista de Sistemas',
        ]);
        DB::table('jobtitles')->insert([
            'title'=>'Auxiliar de Calidad',
        ]);
        DB::table('jobtitles')->insert([
            'title'=>'Auxiliar de Recursos Humanos',
        ]);
        DB::table('jobtitles')->insert([
            'title'=>' Auxiliar de Cartera',
        ]);
    }
}
