<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = [
        'nombre',
        'ubicacion_id',
        'direccion',
        'telefono',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
}
