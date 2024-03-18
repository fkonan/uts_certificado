<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Carbon;

class Certificados extends Model
{
    protected $fillable = [
        'tipo_certificado', 'valor', 'mensaje', 'estado', 'user_id'
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

    public function solicitudes()
    {
        return $this->belongsToMany(Solicitud::class, 'solicitud_certificado', 'solicitud_id', 'certificado_id')->withPivot('id','estado', 'ruta', 'observaciones', 'created_at','updated_at');
    }
}
