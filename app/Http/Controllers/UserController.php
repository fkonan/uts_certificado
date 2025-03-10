<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   public function show($id)
   {
      $user = User::findOrFail($id);
      return view('users.profile', ['user' => $user]);
   }

   public function index()
   {
      $users = User::where('is_admin', 1)->get();
      return view('users.index', ['users' => $users]);
   }

   public function create()
   {
      return view('users.create');
   }

   public function edit($id)
   {
      $user = User::findOrFail($id);
      return view('users.edit', ['user' => $user]);
   }

   protected function validator(array $data)
   {
      $messages = [
         'tipo_documento.required' => 'El tipo de documento es obligatorio.',
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
         'documento' => ['required', 'string', 'max:20', 'unique:users,documento,' . (isset($data['id']) ? $data['id'] : 'NULL')],
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . (isset($data['id']) ? $data['id'] : 'NULL')],
         'password' => [isset($data['id']) ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
      ], $messages);
   }

   public function store(Request $request)
   {
      $validator = $this->validator($request->all());

      if ($validator->fails()) {
         dd($validator->errors());
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->telefono = $request->telefono;
      $user->tipo_documento = $request->tipo_documento;
      $user->documento = $request->documento;
      $user->email_verified_at = now();
      $user->password = bcrypt($request->password);
      $user->save();
      return redirect()->route('user.index')->with('success', 'Usuario creado correctamente');
   }

   public function updateUser(Request $request, $id)
   {
      $validator = $this->validator(array_merge($request->all(), ['id' => $id]));
      if ($validator->fails()) {
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      $user = User::findOrFail($request->id);
      $user->email = $request->email;
      $user->telefono = $request->telefono;
      $user->tipo_documento = $request->tipo_documento;
      $user->documento = $request->documento;
      $user->name = $request->name;

      if ($request->password) {
         $user->password = bcrypt($request->password);
      }

      $user->save();
      return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente');
   }

   public function updateStatusUser($id)
   {
      $user = User::findOrFail($id);
      $user->estado = !$user->estado;
      $user->save();
      return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente');
   }

   //Actualizar perfil estudiante
   public function update(Request $request)
   {
      $rules = [
         'name' => 'required',
         'email' => 'required|email',
         'telefono' => 'required',
         'tipo_documento' => 'required',
         'documento' => 'required',
      ];

      // Agregar reglas para la contraseña si está presente
      if ($request->password) {
         $rules = array_merge($rules, [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
         ]);
      }

      $messages = [
         'name.required' => 'El nombre es obligatorio.',
         'email.required' => 'El correo electrónico es obligatorio.',
         'email.email' => 'El correo electrónico debe ser válido.',
         'telefono.required' => 'El teléfono es obligatorio.',
         'tipo_documento.required' => 'El tipo de documento es obligatorio.',
         'documento.required' => 'El documento es obligatorio.',
         'password.required' => 'La contraseña es obligatoria.',
         'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
         'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
         'password_confirmation.same' => 'La confirmación de la contraseña no coincide.',
      ];

      $validated = $request->validate($rules, $messages);

      $user = User::findOrFail($request->id);
      $user->email = $request->email;
      $user->telefono = $request->telefono;
      $user->tipo_documento = $request->tipo_documento;
      $user->documento = $request->documento;

      if ($request->password) {
         $user->password = bcrypt($request->password);
      }

      $user->save();
      return redirect()->route('user.profile.show', $user->id)->with('success', 'Perfil actualizado correctamente');
   }
}
