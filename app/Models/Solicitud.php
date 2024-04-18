<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitud';

    protected $fillable = [
        'tipo_documento', 'documento', 'nombre_completo', 'telefono', 'correo', 'observaciones', 'observacion_uts', 'egresado', 'adj_documento', 'adj_estampilla', 'adj_pago', 'estado', 'user_id'
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

    public function certificados()
    {
        return $this->belongsToMany(Certificados::class, 'solicitud_certificado', 'solicitud_id', 'certificado_id')->withPivot('id', 'ruta', 'created_at', 'updated_at');
    }
}
