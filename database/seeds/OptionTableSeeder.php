<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('correctoptions')->insert([
            'option'=>'A',

        ]);
        DB::table('correctoptions')->insert([
            'option'=>'B',

        ]);
        DB::table('correctoptions')->insert([
            'option'=>'C',

        ]);
        DB::table('correctoptions')->insert([
            'option'=>'D',

        ]);

    }
}
