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
            'name'=>'Admin',
            'description'=>'',

        ]);
        DB::table('roles')->insert([
            'name'=>'Gerente',
            'description'=>'',

        ]);
        DB::table('roles')->insert([
            'name'=>'Director',
            'description'=>'',

        ]);
        DB::table('roles')->insert([
            'name'=>'Coordinador',
            'description'=>'',

        ]);
        DB::table('roles')->insert([
            'name'=>'Normal',
            'description'=>'',

        ]);
        DB::table('roles')->insert([
            'name'=>'secretaria',
            'description'=>'',

        ]);
    }
}

