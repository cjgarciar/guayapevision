<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeders
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Administrador Super Usuario',
            'email' => 'adminsu@gmail.com',
            'password' => '$2y$10$OvyXzJKfDRfxIWeLpDqmlODj/9HUXo8jnjBSdhQL98RHP.lcfs1qC',
            'forzar_cambio_contrasenia' => false,
        ]);
    }
}
