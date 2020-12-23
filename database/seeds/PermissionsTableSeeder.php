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

        Permission::create(['name' => 'permission_index']);
        Permission::create(['name' => 'permission_create']);
        Permission::create(['name' => 'permission_edit']);
        Permission::create(['name' => 'permission_destroy']);
        Permission::create(['name' => 'permission_assign']);

        Permission::create(['name' => 'administrar_coordinacion']);
        Permission::create(['name' => 'show_role_has_permisssion']);
        Permission::create(['name' => 'remove_role_has_permisssion']);
        Permission::create(['name' => 'permission_roles_index']);

        Permission::create(['name' => 'rol_index']);
        Permission::create(['name' => 'rol_create']);
        Permission::create(['name' => 'rol_edit']);
        Permission::create(['name' => 'rol_destroy']);

        Permission::create(['name' => 'questionnaire_index']);
        Permission::create(['name' => 'questionnaire_create']);
        Permission::create(['name' => 'questionnaire_edit']);
        Permission::create(['name' => 'questionnaire_destroy']);

        Permission::create(['name' => 'questionnaire_present_result']);
        Permission::create(['name' => 'questionnaire_present_index']);
        Permission::create(['name' => 'questionnaire_present_create']);
        Permission::create(['name' => 'questionnaire_present_show']);
        Permission::create(['name' => 'questionnaire_result_index']);
        Permission::create(['name' => 'questionnaire_present_result_details']);

        Permission::create(['name' => 'question_index']);
        Permission::create(['name' => 'question_create']);
        Permission::create(['name' => 'question_edit']);
        Permission::create(['name' => 'question_destroy']);

        Permission::create(['name' => 'event_adverse_index']);
        Permission::create(['name' => 'event_adverse_asing']);

        Permission::create(['name' => 'work_permit_index']);

        Permission::create(['name' => 'change_turn_index']);
        Permission::create(['name' => 'change_turn_register']);

        Permission::create(['name' => 'vacation_index']);
        Permission::create(['name' => 'user_support_index']);
        Permission::create(['name' => 'correspondence_index']);
        Permission::create(['name' => 'traceability_index']);
        Permission::create(['name' => 'form_index']);
        Permission::create(['name' => 'form_send']);

        Permission::create(['name' => 'archive_index']);
        Permission::create(['name' => 'archive_create']);
        Permission::create(['name' => 'archive_edit']);
        Permission::create(['name' => 'archive_destroy']);

        //lista de roles
        $super_admin = Role::create(['name'=>'super-admin']);
        $Gerencia = Role::create(['name'=>'gerencia']);
        $director  = Role::create(['name'=>'director']);
        $coordinador_rrhh =Role::create(['name'=>'coordinador-rrhh']);
        $funcionario = Role::create(['name'=>'funcionario']);
        $secretaria = Role::create(['name'=>'secretaria']);
        $admin = Role::create(['name'=>'admin']);
        $coordinador = Role::create(['name'=>'coordinador']);
        $coordinador_calidad = Role::create(['name'=>'coordinador-calidad']);

        $super_admin->givePermissionTo([
            'user_index','user_create','user_edit','user_destroy',
            'questionnaire_index','questionnaire_create','questionnaire_edit','questionnaire_destroy',
            'question_index','question_create','question_edit','question_destroy',
            'event_adverse_index','event_adverse_asing',
            'work_permit_index',
            'change_turn_index','change_turn_register',
            'vacation_index',
            'archive_index','archive_create','archive_edit','archive_destroy',
            'permission_index','permission_create','permission_edit','permission_destroy',
            'permission_assign','show_role_has_permisssion','remove_role_has_permisssion',
            'permission_roles_index',
            'rol_index','rol_create','rol_edit','rol_destroy',
            'administrar_coordinacion','correspondence_index',
            'questionnaire_present_index','questionnaire_present_create','questionnaire_present_result'
            ,'questionnaire_present_result_details','questionnaire_present_show',
            'questionnaire_result_index','traceability_index','form_index','form_send','vacation_index',
        ]);
        $funcionario->givePermissionTo([
            'archive_index','user_support_index','correspondence_index',
            'questionnaire_present_result','questionnaire_present_index','questionnaire_present_create',
            'questionnaire_present_result_details','questionnaire_present_show','traceability_index',
            'form_index','form_send'
        ]);

        $user = User::find(1);
        $user ->assignRole('super-admin');







    }
}
