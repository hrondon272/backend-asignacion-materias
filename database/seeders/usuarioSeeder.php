<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class usuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'administrador',
            'apellido' => 'Perez',
            'cedula' => '10000000',
            'fecha_nacimiento' => '1978-07-04',
            'direccion' => 'san gregorio',
            'municipio' => 'Villa del rosario',
            'telefono' => '3121245789',
            'sexo' => 'Masculino',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
