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
            'cedula' => 'v-------',
            'fecha_nacimiento' => '1978-07-04',
            'direccion' => 'Santa Teresa',
            'municipio' => 'San Cristobal',
            'telefono' => 'NS',
            'sexo' => 'Masculino',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Maria',
            'apellido' => 'Ramirez',
            'cedula' => 'V14234567',
            'fecha_nacimiento' => '1978-07-04',
            'direccion' => 'Santa Teresa',
            'municipio' => 'San Cristobal',
            'telefono' => 'NS',
            'sexo' => 'Femenino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Carlos',
            'apellido' => 'Castillo',
            'cedula' => '15367789',
            'fecha_nacimiento' => '1979/04/23',
            'direccion' => 'San Cristobal',
            'municipio' => 'San Cristobal',
            'telefono' => '0276-3435566',
            'sexo' => 'Masculino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Cristal',
            'apellido' => 'Pachecho',
            'cedula' => '17543897',
            'fecha_nacimiento' => '1982/05/07',
            'direccion' => 'Capacho',
            'municipio' => 'Libertad',
            'telefono' => '2765432123',
            'sexo' => 'Femenino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Belen',
            'apellido' => 'Garcia',
            'cedula' => 'E81232123',
            'fecha_nacimiento' => '1968/12/15',
            'direccion' => 'El Piñal',
            'municipio' => 'Fernandez Feo',
            'sexo' => 'Femenino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Oscar',
            'apellido' => 'Niño',
            'cedula' => 'v23111239',
            'fecha_nacimiento' => '1990/01/30',
            'direccion' => 'Tariba',
            'municipio' => 'Cardenas',
            'telefono' => '4168798989',
            'sexo' => 'Masculino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Oscar',
            'apellido' => 'Torres',
            'cedula' => 'V20.366.554',
            'fecha_nacimiento' => '1988/01/12',
            'direccion' => 'Abejales',
            'municipio' => 'Libertador',
            'telefono' => '2764532211',
            'sexo' => 'Masculino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Yolimar',
            'apellido' => 'Perez',
            'cedula' => '21388798',
            'fecha_nacimiento' => '1980/09/18',
            'direccion' => 'Rubio',
            'municipio' => 'Junin',
            'telefono' => '0414-7187766',
            'sexo' => 'Femenino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Mayra',
            'apellido' => 'Macea',
            'cedula' => '15.437.515',
            'fecha_nacimiento' => '1981/09/14',
            'direccion' => 'La Fria',
            'municipio' => 'Garcia de Hevia',
            'telefono' => '3432211',
            'sexo' => 'Femenino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'nombre' => 'Miguel',
            'apellido' => 'Zambrano',
            'cedula' => '12.321.333',
            'fecha_nacimiento' => '1979/03/09',
            'direccion' => 'San Antonio',
            'municipio' => 'Bolivar',
            'telefono' => '3564455',
            'sexo' => 'Masculino',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
