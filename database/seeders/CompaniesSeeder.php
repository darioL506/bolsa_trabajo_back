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
        // Se crean 5 empresas con los id 12-16
        $fak = Factory::create('es_ES');
        for ($i = 12; $i <= 16; $i++) {
            $o = new Company();
            $o->cif = $fak->numberBetween(111111111, 999999999);
            $o->name = $fak->name();
            $o->user_id = $i;
            $o->section = $fak->text($maxNbChars = 10);
            $o->foundation = $fak->date();
            $o->description = $fak->text($maxNbChars = 200);
            $o->save();
        }
    }
}