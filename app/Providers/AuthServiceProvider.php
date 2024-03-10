<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('Hola, ' . Str::title($notifiable->name))
                ->subject('Verificación de cuenta.')
                ->line('Para verificar tu cuenta y finalizar tu registro, por favor da click en el siguiente botón: ')
                ->action('Verificación de correo electrónico', $url)
                ->salutation('Cordialmente. '.config('adminlte.entidad'));
        });
    }
}
