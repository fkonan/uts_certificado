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
    protected $redirectTo = '/login';

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
        $messages = [
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'tipo_documento.max' => 'El tipo de documento no puede tener más de :max caracteres.',
            'documento.required' => 'El documento es obligatorio.',
            'documento.max' => 'El documento no puede tener más de :max caracteres.',
            'documento.unique' => 'El documento ya ha sido registrado.',
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'email.unique' => 'El correo electrónico ya ha sido registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
        return Validator::make($data, [
            'tipo_documento' => ['required', 'string', 'max:30'],
            'documento' => ['required', 'string','max:20', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user= User::create([
            'tipo_documento' => $data['tipo_documento'],
            'documento' => $data['documento'],
            'name' => $data['name'],
            'email' => $data['email'],
            'estado' => 1,
            'password' => Hash::make($data['password']),
        ]);

        // $user->sendEmailVerificationNotification();

        return $user;
    }
}
