<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $fak = Factory::create('es_ES');
        $o = new Company();
        $o->cif = $fak->vat;
        $o->name = 'indra';
        $o->section = 'consultora informatica';
        $o->user_id = 4;
        $o->foundation = $fak->date();
        $o->description = 'Empresa lider en el sector informatico .';
        $o->save();
        //EMPRESAS DE PRUEBA
        $fak = Factory::create('es_ES');
        for ($i = 21; $i <= 36; $i++) {
            $o = new Company();
            $o->cif =
                $fak->vat;
            $o->name = $fak->name();
            $o->section = $fak->text($maxNbChars = 10);
            $o->user_id = $i;
            $o->foundation = $fak->date();
            $o->description = $fak->text($maxNbChars = 200);
            $o->save();
        }
    }
}
