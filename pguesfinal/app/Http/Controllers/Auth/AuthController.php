<?php

namespace sispg\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use sispg\Http\Controllers\Controller;
use sispg\User;
use sispg\Rol;
use sispg\Rol_carrera;
use sispg\Persona;

use sispg\Carrera;

use Validator;
use DB;
use Auth;
//use sispg\Http\Requests\LoginFormRequest;
use sispg\Http\Requests\LoginFormRequest;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {   

	$user1 = User::where('email','=',$request->email)->get()->first();
    
   

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user= Auth::user();

 switch ($user1->persona->tipo) {
                case 'estudiante':

           
       
        $user->idcarrera= $user1->persona->estudiante->idcarrera;
                $user->idrol=6;
          $user->update();
            Auth::login($user);
            return redirect('/home');
               
                break;
                case 'docente':

           
       
        $user->idcarrera= null;
                $user->idrol=null;
          $user->update();
            Auth::login($user);
            return redirect('/home');
               
                
                break;
            }


        }else{


        return redirect('login')->withErrors([
            'error' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
}
    }
}
