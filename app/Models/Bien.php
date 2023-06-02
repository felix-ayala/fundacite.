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
        'descripcion',
        'marca',
        'modelo',
        'estatus',
        'cantidad',
        'sede_id',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }
}
