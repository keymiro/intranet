<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Request $request, $id)
    {
        $User = User::findOrFail($id);
        $passOld=$request['passOld'];
        $passNew=$request['passNew'];
        $passNewRepet=$request['passNewRepet'];


        if (Hash::check($passOld,$User->password))
        {
            $rules =[
                     'passNew'=>['required','string', 'min:8'],
                     'passNewRepet'=>['required','string', 'min:8']
                    ];
            $messages =
            [
                'passNew.min'=>'La nueva contraseña debe ser igual o superior a 8 digitos',
                'passNewRepet.min'=>'Repetir nueva contraseña debe ser igual o superior a 8 digitos'
            ];
            $this->validate($request, $rules, $messages);

            if ($passNew==$passNewRepet)
            {
                $User -> update (['password'=>Hash::make($passNew)]);
                return back()
                ->with('notification','Contraseña actualizada correctamente');
            }else{
                return back()
                ->with('error','La nueva contraseña y repetir contraseña no coinciden, por favor verifiquelas');
            }
        }else{
            return back()
            ->with('error','La contraseña anterior no coincide, por favor verifiquela');
        }


     }


}
