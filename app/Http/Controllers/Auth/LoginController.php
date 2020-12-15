<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /* Valida que el usuario este activo
     *
     *
     */

    protected function credentials(Request $request)
    {
        if (['email' => $request->{$this->username()}, 'password' => $request->password, 'state' => 1])
        {
            $this->guard()->logout();
            $request->session()->invalidate();
            return ['email' => $request->{$this->username()}, 'password' => $request->password, 'state' => 1];

        }else {
            return view('/')->withErrors([
                'error' => 'El usuario no es correcto',
            ]);
        }
    }

    /* protected function authenticate(Request $request){

         if (Auth::check() && auth()->user()->state == 2) {

             // usuario con sesión iniciada pero inactivo

             // cerramos su sesión
             Auth::guard()->logout();

             // invalidamos su sesión
             $request->session()->invalidate();

             // redireccionamos a donde queremos
             return  redirect('/');
         }

     }*/


    /*protected function sendFailedLoginResponse(Request $request)
    {

        if ( !User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => 'El usuario no es correcto',
                ]);
        }

        if ( !User::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => 'Error de autenticación',
                ]);
        }


        if ( !User::where('email', $request->email)->where('password', bcrypt($request->password))->where('state', 1)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => 'Usuario desactivado',
                ]);
        }

    }*/
}
