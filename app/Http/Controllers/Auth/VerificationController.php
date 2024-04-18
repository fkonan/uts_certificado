<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return view('auth.verify')->with('success', false);
    }


    public function verify(Request $request)
    {
        // Encuentra el usuario correspondiente al token de verificación
        $user = User::find($request->route('id'));

        // Verifica si el usuario existe y el token de verificación es válido
        if ($user && hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            // Verifica el correo electrónico del usuario
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
                event(new Verified($user));

                // Actualiza el estado del usuario a 1 (o cualquier otro valor que desees)
                $user->update(['estado' => 1]);
            }

            // Redirige al usuario a la página de inicio o a donde desees
            return view('auth.verify')->with('success', true);
        }

        // Si el usuario no se encuentra o el token no es válido, muestra un mensaje de error
        return view('auth.verify');
    }
}
