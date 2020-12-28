<?php

use Illuminate\Support\Facades\Route;

/* ruta para el index */
Route::get('/', 'IndexController@index')->name('index');
/* rutas de login, pero con el registro deshabilitado*/
Auth::routes(['register' => false]);
/* ruta home */
Route::get('/home', 'HomeController@index')->name('home');

// ruta controlador
/*Route::resource('informative','informativeController');*/
/****rutas eventos adversos*******/
Route::post('/evento-adverso', 'FormsController@PostEvent')->name('evento.store');

/********* forms */
Route::get('/Solicitud', 'FormsController@GetReport')->name('forms');
Route::post('/Solicitud', 'FormsController@PostReport');
/* Trazabilida formularios*/
route::get('/trazabilidad', 'FormsController@ListRequest')->name('ListRequest');
route::get('/trazabilidad/detalles-permiso-laboral/{id}', 'FormsController@DetailsWorkPermit')
    ->name('detailsworkpermit.c');
Route::get('/trazabilidad/detalle-cambio-turno/{id}', 'FormsController@DetailsChangeTurn')
    ->name('ChangeTurn.detailsc');
Route::get('/trazabilidad/detalle-vacaciones/{id}', 'FormsController@DetailsWorkVacation')
    ->name('WorkVacation.detailsc');
route::get('/config', 'ConfigController@Index')->name('config');
/* ruta presentar cuestionarios*/
route::get('/resultquestionnaire', 'PresentQuestionnaireController@result')
    ->name('result.questionnaire');
route::resource('presentarq', 'PresentQuestionnaireController');
route::get('resultado-detallado-cuestionario/{idquestionnaire}/{idrepetition}',
    'PresentQuestionnaireController@ResultDetailsQuestionnaire')->name('resultDetails');
/**********forms recursos humanos**********************/
route::post('/permiso-laboral', 'FormsController@PostWorkPermit')->name('WorkPermit.store');
Route::post('/cambio-turno', 'FormsController@PostChangeTurn')->name('ChangeTurn.store');
route::post('/vacaciones-laborales','FormsController@PostWorkVacation')->name('WorkVacation.store');
/****archivo**********************************************************************************/
route::get('/archivos-informativos','ArchiveController@IndexArchive')
    ->name('Archiveindex');
/***************************correspondencia*****************************************/
route::get('/correspondencia','ArchiveController@IndexCorrespondence')
    ->name('Correspondence');

//** Atencion al usuario */

route::get('/user_support','UserSupportController@index')
    ->name('user_support.index');
    /*** notificaciones */
   route::get('/notificaciones', 'NotificationController@index')
    ->name('index.all.Notifications');
    route::get('/notificaciones/read', 'NotificationController@readAllNotifications')
    ->name('Read.all.Notifications');
    route::get('/notificacion/read/{id}', 'NotificationController@readNotification')
    ->name('Read.Notifications');

Route::group(['namespace' => 'Admin'], function () {
    /*--------------------------rutas usuario-----------------------------------------*/
    route::get('/usuarios', 'UserController@Index')
        ->name('usuarios');
        /*->middleware('permission:user_index')*/

    route::post('/usuarios', 'UserController@store')
        ->name('user.store');
     /*   ->middleware('permission:user_create');*/

    route::get('/usuarios/{id}/', 'UserController@edit')
        ->name('edit.user');
      /*  ->middleware('permission:user_edit')*/
    route::patch('/usuarios/{id}/', 'UserController@update')->name('update.user');
    route::get('/usuarios/{id}/inactive', 'UserController@inactive')->name('inactive.user');
    //************Permisos y roles********************************************************************+/
    route::get('/permisos', 'PermissionsController@Index')->name('permisos');
    route::post('/roles/', 'PermissionsController@Store')->name('roles.store');
    route::get('/roles/{id}/edit', 'PermissionsController@Edit')->name('roles.edit');
    route::patch('/roles/{id}/', 'PermissionsController@Update')->name('roles.update');
    route::delete('/roles/{id}/','PermissionsController@Delete')->name('roles.delete');

    route::post('/permisos/', 'PermissionsController@StorePermission')->name('permisos.store');
    route::get('/permisos/{id}/edit', 'PermissionsController@EditPermission')->name('permisos.edit');
    route::patch('/permisos/{id}/', 'PermissionsController@UpdatePermission')->name('permisos.update');
    route::delete('/permisos/{id}/','PermissionsController@DeletePermission')->name('permisos.delete');
    route::post('/asginar-permisos/','PermissionsController@AssignPermission')->name('permisos.assign');
    route::get('/mostrar-permisos/{id}/rol','PermissionsController@ShowRoleHasPermisssion')
    ->name('show.rolehaspermission');
    route::post('/revocar-permiso/{id}/rol','PermissionsController@RemoveRoleHasPermisssion')
        ->name('permisos.remove');


    /****--------------------------rutas cuestionarios--------------------------------------*/
    route::get('/result-questionnaire-find/{id}/ResultadoCuestionarios', 'QuestionnaireController@listresultfind')
        ->name('result.questionnaire.find');
    route::get('/result-questionnaire-find-peoples/{questionnaire_id}/{user_id}/IntentosRealizados',
        'QuestionnaireController@ResultFindPeoples')
        ->name('result.questionnaire.find.peoples');
    route::get('/result-list-questionnaire-find', 'QuestionnaireController@ListQuestionnaire')
        ->name('list.result.questionnaire');
    route::get('/result-questionnaire-details-people/{questionnaire_id}/{user_id}/{repetition_id}/ResultadoDetallado',
        'QuestionnaireController@DetailsResultFindPeoples')
        ->name('result.questionnaire.details.peoples');
    route::resource('questionario', 'QuestionnaireController');
    route::resource('preguntas', 'QuestionController');

    /**********exportar**********************/
    route::get('/exportar-resultados-questionario',
        'QuestionnaireController@ExportQuestionnaire')
        ->name('export');
    /**********forms calidad**********************/
    route::get('Export-adverse-event/{id}', 'FormsController@ExportAdverseEnvent')
        ->name('Export.AdverseEvent');
    route::get('list-adverse-events', 'FormsController@index')->name('AdverseEvent');
    route::get('details-adverse-events/{id}', 'FormsController@DetailsAdverseEnvents')
        ->name('Details.AdverseEvent');
    route::patch('update-adverse-event/{id}/', 'FormsController@UpdateAdverseEnvents')
        ->name('Update.AdverseEvent');
    /********forms recursos humanos*******/
    /***permiso laboral */
    route::get('/list-work-permit','FormsController@ListWorkPermit')
        ->name('list.WorkPermit');
    route::get('/list-work-permit/{id}/details','FormsController@DetailsWorkPermit')
        ->name('details.WorkPermit');
    route::get('/work-permit/{id}/register','FormsController@RegisterWorkPermit')
        ->name('register.WorkPermit');
    route::patch('/work-permit/approve/{WorkPermitId}/off/{off}','FormsController@ApproveWorkPermit')
        ->name('approve.WorkPermit');
        /**cambio de turno */
    Route::get('/list-change-turn', 'FormsController@ListChangeTurn')
    ->name('ChangeTurn.list');
    Route::get('/list-change-turn/details/{id}', 'FormsController@DetailsChangeTurn')
    ->name('ChangeTurn.details');
    route::get('/change-turn/register/{id}','FormsController@RegisterChangeturn')
        ->name('register.ChangeTurn');
    route::patch('/change-turn/approve/{ChangeTurnId}/off/{off}','FormsController@ApproveChangeTurn')
        ->name('approve.ChangeTurn');
    /***vacaciones */////
    route::get('/list-work-vacation','FormsController@listWorkVacation')
        ->name('WorkVacation.list');
    route::get('/list-work-vacation/details/{id}','FormsController@DetailsWorkVacation')
        ->name('WorkVacation.Details');
    route::patch('/work-vacation/approve/{WorkVacationId}/off/{off}','FormsController@ApproveWorkVacation')
        ->name('approve.WorkVacation');
   //*** archivos***//
    route::get('/archive','ArchiveController@IndexArchive')
        ->name('Archive.index');
    route::post('/archive/create','ArchiveController@PostArchive')
        ->name('Archive.Post');
    route::get('/archive/Edit/{id}','ArchiveController@EditArchive')
        ->name('Archive.Edit');
    route::patch('/archive/update/{id}','ArchiveController@UpdateArchive')
        ->name('Archive.Update');
    route::delete('/archive/delete/{id}','ArchiveController@DeleteArchive')
        ->name('Archive.Delete');


});


