<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //lista de permisos
        Permission::create(['name' => 'user_index']);
        Permission::create(['name' => 'user_create']);
        Permission::create(['name' => 'user_edit']);
        Permission::create(['name' => 'user_destroy']);

        Permission::create(['name' => 'questionnaire_index']);
        Permission::create(['name' => 'questionnaire_create']);
        Permission::create(['name' => 'questionnaire_edit']);
        Permission::create(['name' => 'questionnaire_destroy']);

        Permission::create(['name' => 'event_adverse_index']);
        Permission::create(['name' => 'event_adverse_create']);
        Permission::create(['name' => 'event_adverse_edit']);
        Permission::create(['name' => 'event_adverse_destroy']);

        Permission::create(['name' => 'work_permit_index']);
        Permission::create(['name' => 'work_permit_create']);
        Permission::create(['name' => 'work_permit_edit']);
        Permission::create(['name' => 'work_permit_destroy']);

        Permission::create(['name' => 'change_turn_index']);
        Permission::create(['name' => 'change_turn_create']);
        Permission::create(['name' => 'change_turn_edit']);
        Permission::create(['name' => 'change_turn_destroy']);

        Permission::create(['name' => 'vacations_index']);
        Permission::create(['name' => 'vacations_create']);
        Permission::create(['name' => 'vacations_edit']);
        Permission::create(['name' => 'vacations_destroy']);

        Permission::create(['name' => 'archive_index']);
        Permission::create(['name' => 'archive_create']);
        Permission::create(['name' => 'archive_edit']);
        Permission::create(['name' => 'archive_destroy']);

        //lista de roles
        $admin = Role::create(['name'=>'admin']);
        $Gerencia = Role::create(['name'=>'gerencia']);
        $director  = Role::create(['name'=>'director']);
        $coord = Role::create(['name'=>'coord']);
        $funcionario = Role::create(['name'=>'funcionario']);
        $secretaria = Role::create(['name'=>'secretaria']);

        $admin->givePermissionTo([
            'user_index','user_create','user_edit','user_destroy',
            'questionnaire_index','questionnaire_create','questionnaire_edit','questionnaire_destroy',
            'event_adverse_index','event_adverse_create','event_adverse_edit','event_adverse_destroy',
            'work_permit_index','work_permit_create','work_permit_edit','work_permit_destroy',
            'change_turn_index','change_turn_create','change_turn_edit','change_turn_destroy',
            'vacations_index','vacations_create','vacations_edit','vacations_destroy',
            'archive_index','archive_create','archive_edit','archive_destroy',
        ]);
        $user = User::find(1);
        $user ->assignRole('admin');







    }
}
