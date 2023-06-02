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
        'cantidad'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function bien()
    {
        return $this->belongsTo(Bien::class,'bien_id');
    }
}
