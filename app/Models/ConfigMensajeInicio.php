<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Carbon;

class ConfigMensajeInicio extends Model
{
   protected $table = 'config_mensaje_inicio';
   protected $fillable = [
      'banner',
      'titulo_video',
      'url_video',
      'texto1',
      'texto2',
      'user_id'
   ];

   public function getCreatedAtAttribute($value)
   {

      return Carbon::parse($value)->setTimezone(config('app.timezone'))->format('d/m/Y H:i:s');
   }

   public function getUpdatedAtAttribute($value)
   {
      return Carbon::parse($value)->setTimezone(config('app.timezone'))->format('d/m/Y H:i:s');
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }
}
