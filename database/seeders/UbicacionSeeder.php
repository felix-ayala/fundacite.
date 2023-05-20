<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ubicacion;
use App\Models\Sede;
class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear ubicaciones
        $ubicaciones = [
            "Amazonas", "Anzoátegui", "Apure", "Aragua", "Barinas", "Bolívar", "Carabobo", "Cojedes", "Delta Amacuro",
            "Distrito Capital", "Falcón", "Guárico", "Lara", "Mérida", "Miranda", "Monagas", "Nueva Esparta", "Portuguesa",
            "Sucre", "Táchira", "Trujillo", "Vargas", "Yaracuy", "Zulia"
        ];
        foreach ($ubicaciones as $ubicacion) {
            Ubicacion::create(['nombre' => $ubicacion]);
        }
        
        // Crear oficinas de prueba
        Sede::create([
            'nombre'        => 'FUNDACION OCCIDENTAL',
            'ubicacion_id'  => 6,
            'direccion'     => 'Puerto Ordaz',
            'telefono'      => '+58413652321'
        ]);
    }
}
