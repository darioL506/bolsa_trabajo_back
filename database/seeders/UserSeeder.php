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
        for($i=1;$i<=10;$i++){
            $u = new \App\Models\User;
            $u->email = $fak->email;
            $u->password = \Hash::make($fak->password);
            $u->save();
        }
    }
}
