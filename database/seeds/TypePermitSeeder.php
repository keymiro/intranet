<?php

use Illuminate\Database\Seeder;
use App\TypePermit;
class TypePermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('type_permits')->insert([
            'name'=>'Cita Médica por Enfermedad Laboral',

        ]);
        DB::table('type_permits')->insert([
            'name'=>'Cita Médica por Enfermedad General',

        ]);
        DB::table('type_permits')->insert([
            'name'=>'Diligencia Personal',

        ]);
        DB::table('type_permits')->insert([
            'name'=>'Compensatorio',

        ]);
        DB::table('type_permits')->insert([
            'name'=>'Actividad Laboral',

        ]);
        DB::table('type_permits')->insert([
            'name'=>'Otro',

        ]);
    }
}
