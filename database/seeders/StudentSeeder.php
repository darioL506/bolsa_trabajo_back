<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dni = ['97015703R','51676027H','20534040P','51994575Q','80470435J',
            '45116807F','97598233X','55524145Y','01966659K','69841291C','17400270B'];
        $studies = ['Informatica','Comercio'];
        $fak = \Faker\Factory::create('es_ES');
        // Se crean 10 estudiantes con la id 2-11
        for($i=2;$i<=11;$i++){
            $st = new Student();
            $st->name = $fak->firstName;
            $st->lastnames = $fak->lastName;
            $st->dni = $dni[$i-1];
            $st->user_id = $i;
            $st->birthdate = $fak->date('Y-m-d');
            $st->phone = $fak->numberBetween(100000000,999999999);
            $st->aptitudes = $fak->paragraph(3);
            $st->save();
        }
    }
}