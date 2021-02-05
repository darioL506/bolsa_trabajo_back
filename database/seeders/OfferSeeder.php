<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Se crean 10 ofertas relacionadas con los id 11-15 que son los id de las compañias
        $fak = \Faker\Factory::create('es_ES');
        for($i=1;$i<=10;$i++){
            $o = new \App\Models\Offer;
            $o->name = $fak->catchPhrase;
            $o->vacant = $fak->numberBetween(1, 20);
            $o->startDate = $fak->date;
            $o->endDate = $fak->date;
            $o->description = $fak->text($maxNbChars = 150);
            $o->company_id = $fak->numberBetween(1, 5);
            $o->area_id = $fak->numberBetween(1, 19);
            $o->save();
        }
    }
}
