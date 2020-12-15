<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\Jobtitle;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\User;
use App\People;


use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user_index')->only('Index');
        $this->middleware('permission:user_create')->only('store');
        $this->middleware('permission:user_edit')->only('edit');
        $this->middleware('permission:user_edit')->only('Update');
        $this->middleware('permission:user_destroy')->only('inactive');
    }

    function Index() {

        $Users  = User::with('people','people.area', 'people.jobtitle')
            ->where('users.state','1')->get();
        $Areas = Area::all();
        $Jobtitles = Jobtitle::all();
        $Roles = Role::all();

        return view('admin.users.index')
            ->
        with(compact('Areas',
                'Jobtitles',
                            'Roles',
                            'Users',

            ));
    }

    function store(Request $request) {
        /*$this->authorize('permission:user_create');*/
        $rules =[
            'document'=>['required'],
            'email'=>['required', 'string', 'email', 'max:255'],
            'password'=>['required', 'string', 'min:8'],
            'role'=>['required', 'exists:roles,id'],
            'type_func'=>['required'],
            'state'=>['required'],
            'names'=>['required'],
            'lastnames'=>['required'],
            'datebirth'=>['required'],
            'phone'=>['required'],
            'address' => ['required'],
            'area'=>['required', 'exists:areas,id'],
            'jobtitles'=>['required', 'exists:jobtitles,id'],
        ];
        $messages = [
            'document.required'=>'El documento de identificación es obligatorio',
            'email.required'=>'El correo electrónico es obligatorio',
            'password.required'=>'La contraseña es obligatoria',
            'role.required'=>'El rol es obligatorio',
            'type_func.required'=>'El tipo funcionario es obligatorio',
            'state.required'=>'El estado es obligatorio',
            'names.required'=>'Los nombres son obligatorios',
            'lastnames.required'=>'Los apellidos son obligatorios',
            'datebirh.required'=>'La fecha de nacimiento es obligatoria',
            'phone.required'=>'El número telefónico es obligatorio',
            'address.required'=>'La dirección es obligatoria',
            'area.required'=>'El área es obligatoria',
            'jobtitles.required'=>'El cargo es obligatorio',
        ];
        $this->validate($request, $rules, $messages);

        $people= new people();
        $people->document = $request->input('document');
        $people->names = $request->input('names');
        $people->lastnames = $request->input('lastnames');
        $people->datebirth = $request->input('datebirth');
        $people->phone = $request->input('phone');
        $people->address = $request->input('address');
        $people->area_id = $request->input('area');
        $people->jobtitle_id = $request->input('jobtitles');
        $people->save();

        $user = new user();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->state = $request->input('state',1);
        $user->type_func = $request->input('type_func');
        $user->people_id = $people->id;
        $user->save();
        $user->syncRoles($request->input('role'));
        return back()->with('notification','Usuario registrado correctamente.');
    }
    function edit($id)
    {
        User::findOrFail($id);
        $user= User::with('people','people.area', 'people.jobtitle')
            ->where('users.id',$id)->get();
        $Roles= Role::all();
        $Jobtitles = Jobtitle::all();
        $Areas = Area::all();

           ;

        return view('admin.users.edit',
            compact('user','Roles','Jobtitles','Areas'));
    }
    function update(Request $request, $id)
    {

        $User = User::findOrFail($id);
        if ($request['password']!=$User->password) {
            $password = Hash::make($request['password']);
        }else {
            $password =$request['password'];
        }
        $User -> update
        ([
            'email'=>$request['email'],
            'password'=>$password,
            'state'=>$request['state'],
            'type_func'=>$request['type_func'],

        ]);
        $User->syncRoles($request->input('role_id'));
        $people = People::findOrfail($User->people_id);
        $people -> update
        ([
            'document'=>$request['document'],
            'names'=>$request['names'],
            'lastnames'=>$request['lastnames'],
            'datebirth'=>$request['datebirth'],
            'phone'=>$request['phone'],
            'address'=>$request['address'],
            'area_id'=>$request['area_id'],
            'jobtitle_id'=>$request['jobtitle_id'],
        ]);
        return redirect(route('usuarios'))
            ->with('notification','Usuario actualizado correctamente.');
    }
    public function inactive($id)
    {
        $User = User::findOrFail($id);
        $User -> update
        (['state'=>'2',]);
        return redirect(route('usuarios'))
            ->with('notification','Usuario inactivado correctamente.');
    }
}
