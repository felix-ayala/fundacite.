<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Equipos',
            'descripcion'=> '',
        ]);

        Categoria::create([
            'nombre' => 'Artefactos electrónicos',
            'descripcion'=> '',
        ]);

        Categoria::create([
            'nombre' => 'Suministros',
            'descripcion'=> '',
        ]);

        Categoria::create([
            'nombre' => 'Otros',
            'descripcion'=> '',
        ]);
    }
}
