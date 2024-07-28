<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_area' => ["required"],
            'id_empresa' => ["required"],
            'id_estado_usuario' => ["required"],
            'id_licencia' => ["required"],
            'id_rol' => ["required"],
            'pagina_web' => ["required"],
            'telefono' => ["required"],
            'id_turno' => ["required"],
            'contra_update' => ["required"],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            "id_area" => $data["id_area"],
            "id_empresa" => $data["id_empresa"],
            "id_estado_usuario" => $data["id_estado_usuario"],
            "id_licencia" => $data["id_licencia"],
            "id_rol" => $data["id_rol"],
            "pagina_web" => $data["pagina_web"],
            "telefono" => $data["telefono"],
            "id_turno" => $data["id_turno"],
            "contra_update" => $data["contra_update"],
        ]);
    }
}
