<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $u->password = \Hash::make('!aA123456');
        $u->save();
        // Se crean 15 usuarios
        for($i=1;$i<=15;$i++){
            $u = new \App\Models\User;
            $u->email = $fak->email;
            $u->password = \Hash::make($fak->password);
            $u->save();
        }
    }
}
