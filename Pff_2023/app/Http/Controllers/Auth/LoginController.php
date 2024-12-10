<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Http\Request;

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
    public function redirectTo()
    {
        // Récupère l'utilisateur actuellement authentifié
        $user = Auth::user();
    
        // Vérifie le profil de l'utilisateur
        if ($user->profil == "Patient") {
            // Redirige les patients vers la page '/patients'
            $this->redirectTo = '/patient/accueilPatient';
        } elseif ($user->profil === "Admin") {
            // Redirige les administrateurs vers la page '/admin'
            $this->redirectTo = '/admin/accueil';
        }elseif ($user->profil === "Medecin") {
            // Redirige les administrateurs vers la page '/admin'
            $this->redirectTo = '/medecin/accueil';
        } else {
            // Redirige les utilisateurs avec d'autres profils (par exemple, 'Eleveur') vers la page '/moutons'
            $this->redirectTo = '/moutons';
        }
    
        return $this->redirectTo;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // Vérifiez si l'utilisateur est bloqué
            if (auth()->user()->blocked) {
                auth()->logout();
                return redirect('/login')->withErrors(['blocked' => 'Votre compte est bloqué.']);
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

}

