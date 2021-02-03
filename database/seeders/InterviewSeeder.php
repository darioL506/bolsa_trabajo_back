<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interview;
use Faker\Factory;

class InterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creamos 20 envios a las ofertas desde los alumnos
        $fak = Factory::create('es_ES');
        for($i=1;$i<=10;$i++){
            $o = new Interview;
            $o->student_id = $fak->numberBetween(1, 10);
            $o->offer_id = $fak->numberBetween(1, 10);
            $o->send_to = 1;
            $o->save();
        }

        // Creamos 20 envios a las ofertas desde los alumnos
        $fak = Factory::create('es_ES');
            for($i=1;$i<=10;$i++){
                $o = new Interview;
                $o->student_id = $fak->numberBetween(1, 5);
                $o->offer_id = $fak->numberBetween(1, 10);
                $o->send_to = 0;
                $o->save();
        }
    }
}
