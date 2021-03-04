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
        for ($j = 1; $j <= 18; $j++) {

            for ($i = 1; $i <= 90; $i++) {
                if($fak->numberBetween(0, 1)==1) {
                    $o = new Interview;
                    $o->student_id = $j;
                    $o->offer_id = $i;
                    $o->Joined_by = $fak->numberBetween(0, 1);
                    $o->isActive = $fak->numberBetween(0, 2);
                    $o->save();
                }
            }
        }
    }
}
