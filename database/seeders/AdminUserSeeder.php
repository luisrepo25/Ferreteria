<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear el Usuario base
        $admin = \App\Models\Usuario::updateOrCreate(
            ['ci' => 1234567], // CI de ejemplo
            [
                'nombre' => 'Administrador',
                'apellido' => 'General',
                'telefono' => 70000000,
                'sexo' => 'M',
                'email' => 'admin@ferre.bo',
                'domicilio' => 'Central Ferretería',
                'tipoPersona' => 'E', // Empleado
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );

        // 2. Registrarlo como Empleado
        \App\Models\Empleado::updateOrCreate(
            ['ci' => $admin->ci],
            [
                'salario' => 5000.00,
                'estado' => 'Activo'
            ]
        );

        // 3. Asignarle el ROL de Administrador (ID 1 según tu script)
        \App\Models\EstadoRol::updateOrCreate(
            [
                'id_rol' => 1, 
                'ci_empleado' => $admin->ci
            ],
            [
                'fechaInicio' => now(),
                'estado' => 'Activo'
            ]
        );
    }
}
