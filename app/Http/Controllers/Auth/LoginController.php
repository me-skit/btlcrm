<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Models\User;

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

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'active' => 1], $request->remember)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }
        else
        {
            $user = User::where('email', $request->email)->first();
            if ($user)
            {
                if ($user->active == 0)
                {
                    return redirect('/login')->with('warning', 'Su cuenta esta deshabilitada, debe hablar con su administrador');
                }
                else {
                    return redirect('/login')->with('error', 'Verifique que su correo y contraseña sean los correctos');
                }
            }

            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);    
        }
    }
}
