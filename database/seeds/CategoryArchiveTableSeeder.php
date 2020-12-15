<?php

use Illuminate\Database\Seeder;

class CategoryArchiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_archives')->insert([
            'name'=>'Archivo',
        ]);
        DB::table('category_archives')->insert([
            'name'=>'Correspondencia',
        ]);
        DB::table('category_archives')->insert([
            'name'=>'Presentaciones',
        ]);

    }
}
