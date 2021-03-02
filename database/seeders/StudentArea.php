<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudentArea extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fak = \Faker\Factory::create('es_ES');
        for ($i = 5; $i <= 20; $i++) {
            $o = new \App\Models\StudentArea();
            $o->user_id = $i;
            $o->area_id = $fak->numberBetween(1, 19);
            $o->save();
        }
        for ($i = 0; $i <= 2; $i++) {
            $o = new \App\Models\StudentArea();
            $o->user_id = 3;
            $o->area_id = $fak->numberBetween(1, 19);
            $o->save();
        }
        for ($i = 1; $i <= 4; $i++) {
            $o = new \App\Models\StudentArea();
            $o->user_id = 2;
            $o->area_id = $fak->numberBetween(1, 19);
            $o->save();
        }
        //
    }
}
