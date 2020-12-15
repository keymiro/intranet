<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PermissionsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

        //ROL
        $this->middleware('permission:permission_roles_index')->only('Index');
        $this->middleware('permission:rol_create')->only('Store');
        $this->middleware('permission:rol_edit')->only('Edit');
        $this->middleware('permission:rol_edit')->only('Update');
        $this->middleware('permission:rol_destroy')->only('Delete');
        //PERMISOS
        $this->middleware('permission:permission_create')->only('StorePermission');
        $this->middleware('permission:permission_edit')->only('EditPermission');
        $this->middleware('permission:permission_edit')->only(' UpdatePermission');
        $this->middleware('permission:permission_destroy')->only('DeletePermission');
        $this->middleware('permission:permission_assign')->only('AssignPermission');
        $this->middleware('permission:show_role_has_permisssion')->only('ShowRoleHasPermisssion');
        $this->middleware('permission:remove_role_has_permisssion')->only('RemoveRoleHasPermisssion');


    }
//roles
    public function Index()
    {

        $roles=Role::select('*')->get();
        $permissions = Permission::all();
        $user = User::select('id','email')->get();

        return view('admin.permissions.index',
            compact('roles','permissions','user'));
    }

    public function Store(Request $request)
    {
        $role =Role::where('name',$request['name'])
            ->first();

        if ($role)
        {
         return back()
             ->with('error','El rol que acaba de ingresar ya existe');
        }else{
            Role::create
            ([
                'name'=>$request['name'],
            ]);
            return  back()
                ->with('notification','Rol creado correctamente');
        }
    }
    public function Edit($id)
    {
        $roles = Role::findOrFail($id);

        return view('admin.permissions.edit_roles',
            compact('roles'));
    }
    public function Update(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        $role -> update ([
            'name'=>$request['name']
        ]);
        return redirect(route('permisos'))
            ->with('notification','Rol ['.$request['name'].'] actualizado correctamente');
    }
    public  function Delete($id)
    {
        Role::findOrFail($id)->delete();
        return back()
            ->with('notification','Rol eliminado correctamente');
    }

//permisos
    public function StorePermission(Request $request)
    {
        $p =Permission::where('name',$request['name'])
            ->first();

        if ($p)
        {
            return back()
                ->with('error','El permiso que acaba de ingresar ya existe');
        }else{
            Permission::create
            ([
                'name'=>$request['name'],
            ]);
            return  back()
                ->with('notification','Permiso creado correctamente');

        }

    }
    public function EditPermission($id)
    {
        $p = Permission::findOrFail($id);

        return view('admin.permissions.edit_permissions',
            compact('p'));
    }
    public function UpdatePermission(Request $request, $id)
    {
        $p = Permission::findOrFail($id);
        $p -> update ([
            'name'=>$request['name']
        ]);
        return redirect(route('permisos'))
            ->with('notification','Permiso ['.$request['name'].'] actualizado correctamente');
    }
    public function DeletePermission($id)
    {

        Permission::findOrFail($id)->delete();
        return back()
            ->with('notification','Permiso eliminado correctamente');
    }

    public function AssignPermission(Request $request)

    {

     $r=$request['rol'];
     $p=$request['permission'];
        if (empty($r)) {
            return back()
                ->with('error','No  ha seleccionado un rol');
        }

     if (empty($p)) {
         return back()
             ->with('error','No  ha seleccionado ningún permiso');
     }

     if (count($p)>0)
        {
            $rol = Role::find($r);
               if ($rol)
               {
                   foreach ($p as $item=>$v)
                   {
                           $p[$item];
                       $rol->givePermissionTo($p);

                   }
                   return back()
                       ->with('notification','Permisos asignado correctamente');
               }
        }

     }

     public function ShowRoleHasPermisssion($id)
     {
       $role = Role::find($id);
       $allPermissions= $role->getAllPermissions();
       return view('admin.permissions.show_permission_has_role',
            compact('role','allPermissions'));

     }
     public function RemoveRoleHasPermisssion(Request $request, $id)
     {
         $p = $request['permission'];
             if (empty($p)) {
                 return back()
                     ->with('error','No se ha seleccionado ningún permiso');
             }
         if (count($p)>0)
         {
             $role = Role::find($id);
             if ($role)
             {
                 foreach ($p as $item)
                 {
                     $role->revokePermissionTo($item);
                 }
                 return back()
                     ->with('notification','Permisos revocados correctamente');
             }
         }
     }





}
