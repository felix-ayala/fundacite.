<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $table = 'movimientos';

    protected $fillable = [
        'fecha_movimiento',
        'descripcion',
        'tipo_movimiento',
        'usuario_id',
        'bien_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function bienes()
    {
        return $this->hasMany(Bien::class);
    }
}
