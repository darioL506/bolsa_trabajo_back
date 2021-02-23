<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Env;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fak = \Faker\Factory::create('es_ES');
        // Usuario que luego sera superadmin
        $u = new \App\Models\User;
        $u->email = 'admin@admin.com';
        $u->password = \Hash::make('PASSWORD_DEFAULT');
        $u->save();
        // Estudiante 1
        $u = new \App\Models\User;
        $u->email = 'dario@gmail.com';
        $u->password = \Hash::make('PASSWORD_DEFAULT');
        $u->save();

        // Estudiante 2
        $u = new \App\Models\User;
        $u->email = 'isra@gmail.com';
        $u->password = \Hash::make('PASSWORD_DEFAULT');
        $u->save();

        //Empresa
        $u = new \App\Models\User;
        $u->email = 'indra@gmail.com';
        $u->password = \Hash::make('PASSWORD_DEFAULT');
        $u->save();

        // Se crean 15 usuarios
        for ($i = 5; $i <= 15; $i++) {
            $u = new \App\Models\User;
            $u->email = $fak->email;
            $u->password = \Hash::make('PASSWORD_DEFAULT');
            $u->save();
        }
    }
}
