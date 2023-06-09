<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email'=> 'admin@example.com',
            'password'=> bcrypt('12345678')
        ])->assignRole('Administrador');
        
        User::create([
            'name' => 'Transcriptor',
            'email'=> 'transcriptor@example.com',
            'password'=> bcrypt('12345678')
        ])->assignRole('Transcriptor');

    }
}
