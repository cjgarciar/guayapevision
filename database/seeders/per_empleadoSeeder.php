<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class per_empleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('per_empleado')->insert([
            'primer_nombre' => 'Super',
            'segundo_nombre' => 'Usuario',
            'primer_apellido' => 'Admin',
            'identidad' => '000000000',
            'telefono' => '0000000',
            'domicilio' => 'Tegucigalpa',
            'id_usuario' => 1,
            'correo' => 'admin',
            'id_ciudad_procedencia' => 107,
            'id_cargo' => 4,
        ]);
    }
}
