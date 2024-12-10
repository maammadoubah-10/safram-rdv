<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profil' => ['required', 'in:Medecin,Patient,Admin'],
        ]);

        // Personnalisation de la règle "unique" pour le profil "Admin"
        $validator->sometimes('profil', 'unique:users,profil', function ($input) {
            return $input['profil'] === 'Admin' && User::adminExists();
        });

        return $validator;
    }

    protected function create(array $data)
    {
        if ($data['profil'] === 'Admin' && User::adminExists()) {
            return redirect()->back()->withInput()->withErrors(['profil' => 'Désolé, tu ne peux pas t\'inscrire en tant qu\'administrateur.']);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'profil' => $data['profil'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
