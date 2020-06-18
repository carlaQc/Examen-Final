<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_attemps(Request $request){ 
        $date = Carbon::now(); 

        $user = User::where('email',$request->email)->first();

        if(empty($user)){
            //Correo electronico incorrecto
            $data['state'] = 'email';
            $data['msg']   = 'Email incorrecto.';
            return $data;
        }elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password]) && date('Y-m-d H:i:s') > $user->date_attempts){
            //Verificacion de Email y Contraseña 
            //cuando los datos son correctos
            $user->attempts = 0;
            $user->date_attempts = null;
            $user->save();
            $data['state'] = 'success';
            return $data;
        }elseif($user->attempts < 5){
            $data['state'] = 'password';
            $data['msg']  = 'Contraseña incorrecta.';
            $user->attempts += 1;
            $user->save();
            return $data;
        }elseif(empty($user->date_attempts)){
            $user->date_attempts = Carbon::now()->addMinutes(5);
            $user->save();
            $data['state'] = 'password';
            $data['msg']   = 'Demasiados intentos, fuiste bloqueado por 5 minutos.';
            return $data;
        }elseif(Carbon::now() <= $user->date_attempts){
            $date = new Carbon($user->date_attempts);
            $minutes = Carbon::now()->diffInMinutes($date);
            if ($minutes > 0) {
                $data['state'] = 'password';
                $data['msg']   = 'Demasiados intentos, intente nuevamente en '.$minutes.' minutos.';
                return $data;
            } else {
                $seconds = Carbon::now()->diffInSeconds($date);
                $data['state'] = 'password';
                $data['msg']   = 'Demasiados intentos, intente nuevamente en '.$seconds.' segundos.';
                return $data;
            }
        }else{
            $user->attempts      = 1;
            $user->date_attempts = null;
            $data['state'] = 'password';
            $data['msg']  = 'Contraseña incorrecta.';
            $user->save();
            return $data;
        }

    }
}
