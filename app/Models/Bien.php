<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $table='bienes';

    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'marca',
        'modelo',
        'serie',
        'descripcion',
        'estatus',
        'ubicacion',
        'fecha_ingreso',
        'movimiento_id',
    ];

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
}
