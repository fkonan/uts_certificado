<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Certificados extends Model
{
    protected $fillable = [
        'tipo_certificado', 'valor', 'mensaje', 'estado','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}