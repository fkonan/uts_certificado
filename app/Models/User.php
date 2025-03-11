<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
   use HasApiTokens, HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'tipo_documento',
      'documento',
      'name',
      'email',
      'telefono',
      'password',
      'estado',
      'is_admin',
   ];

   protected static function booted()
   {
      static::creating(function ($user) {
         // Asignamos valores predeterminados si no están definidos
         $user->estado = $user->estado ?? 1;
         $user->is_admin = $user->is_admin ?? 1;
      });
   }

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
      'password',
      'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
   ];

   public function adminlte_profile_url()
   {
      return 'users/' . $this->id . '/profile';
   }

   public function solicitudes()
   {
      return $this->hasMany(Solicitud::class);
   }

   public function certificados()
   {
      return $this->hasMany(Certificados::class);
   }
}
