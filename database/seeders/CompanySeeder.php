<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fak = Factory::create('es_ES');
        for ($i = 1; $i <= 10; $i++) {
            $o = new Companies();
            $o->cif = $fak->numberBetween(111111111, 999999999);
            $o->name = $fak->name();
            $o->section = $fak->text($maxNbChars = 10);
            $o->foundation = $fak->date();
            $o->description = $fak->text($maxNbChars = 200);
            $o->save();

        }
    }
}