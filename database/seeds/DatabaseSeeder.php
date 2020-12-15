<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call(LocationsTableSeeder::class);
        $this->call(PrioritiesTableSeeder::class);
   /*     $this->call(RolesTableSeeder::class);*/
        $this->call(JobtitlesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(PeoplesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OptionTableSeeder::class);
        $this->call(TypePermitSeeder::class);
        $this->call(CategoryArchiveTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);




    }
}
