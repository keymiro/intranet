<?php

use Illuminate\Database\Seeder;
use App\People;
use Illuminate\Support\Facades\DB;

class PeoplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('peoples')->insert([
            'document'=>'1118567887',
            'names'=>'Eddison Camilo',
            'lastnames'=>'Mancipe Diaz',
            'datebirth'=>'1997-04-29',
            'phone'=>'3217140228',
            'address'=>'calle 31-13-36',
            'jobtitle_id'=>'1',
            'area_id'=>'1',

        ]);

    }
}
