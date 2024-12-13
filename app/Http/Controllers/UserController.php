<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function show($id)
	{
		$user = User::findOrFail($id);
		return view('users.profile', ['user' => $user]);
	}

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
