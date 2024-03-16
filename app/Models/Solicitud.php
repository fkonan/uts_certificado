<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitud';

    protected $fillable = [
        'tipo_documento', 'documento', 'nombre_completo', 'telefono', 'correo', 'observaciones', 'egresado', 'adj_documento', 'adj_estampilla', 'adj_pago', 'estado', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificados()
    {
        return $this->belongsToMany(Certificados::class, 'solicitud_certificado', 'solicitud_id', 'certificado_id');
    }
}
