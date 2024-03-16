<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCertificado extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificado_id','solicitud_id'
    ];

    public function certificado()
    {
        return $this->belongsTo(Certificados::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
