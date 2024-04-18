<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCertificado extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificado_id', 'solicitud_id',  'user_id', 'ruta'
    ];

    public function getCreatedAtAttribute($value)
    {

        return Carbon::parse($value)->setTimezone(config('app.timezone'))->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(config('app.timezone'))->format('d/m/Y H:i:s');
    }

    public function certificado()
    {
        return $this->belongsTo(Certificados::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}
