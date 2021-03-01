<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRol;
use Faker\Factory;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Asignamos los roles a los usuarios creados
        // El primero es el superadmin que hemos creado
        $o = new UserRol;
        $o->user_id = 1;
        $o->rol_id = 1;
        $o->save();

        $o = new UserRol;
        $o->user_id = 2;
        $o->rol_id = 3;
        $o->save();

        $o = new UserRol;
        $o->user_id = 3;
        $o->rol_id = 3;
        $o->save();

        $o = new UserRol;
        $o->user_id = 4;
        $o->rol_id = 4;
        $o->save();

        // Creamos los roles de estudiantes y compañias
        $fak = \Faker\Factory::create('es_ES');
        // Estudiantes
        for ($i = 5; $i <= 20; $i++) {
            $o = new UserRol;
            $o->user_id = $i;
            $o->rol_id = 3;
            $o->save();
        }
        // Empresas
        for ($i = 21; $i <= 36; $i++) {
            $o = new UserRol;
            $o->user_id = $i;
            $o->rol_id = 4;
            $o->save();
        }
    }
}
