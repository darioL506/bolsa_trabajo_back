<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfferArea;
use Faker\Factory;

class OfferAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // Asignamos un ciclo a cada oferta
    $fak = Factory::create('es_ES');
    for($i=1;$i<=10;$i++){
        $o = new OfferArea;
        $o->offer_id = $i;
        $o->area_id = $fak->numberBetween(1, 19);
        $o->save();
        }
    }
}
