<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Certificados extends Model
{
    protected $fillable = [
        'tipo_certificado', 'valor', 'mensaje', 'estado','user_id'
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
