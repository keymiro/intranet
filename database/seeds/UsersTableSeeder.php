<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        DB::table('users')->insert([
           'email'=>'admin@gmail.com',
           'password'=> Hash::make('12345678'),
            'state'=>'1',
            'type_func'=>'1',

          /*  'role_id'=>'1',*/
            'people_id'=>'1',

        ]);


    }
}
