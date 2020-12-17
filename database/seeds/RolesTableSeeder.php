<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'super-admin',
        ]);
        DB::table('roles')->insert([
            'name'=>'gerencia',
        ]);
        DB::table('roles')->insert([
            'name'=>'director',
        ]);
        DB::table('roles')->insert([
            'name'=>'Coordinador-rrhh',


        ]);
        DB::table('roles')->insert([
            'name'=>'Normal',

        ]);
        DB::table('roles')->insert([
            'name'=>'secretaria',
        ]);
        DB::table('roles')->insert([
            'name'=>'admin',
        ]);
    }
}

