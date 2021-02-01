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
        for($i=1;$i<=10;$i++){
            $st = new Student();
            $st->name = $fak->firstName;
            $st->lastnames = $fak->lastName;
            $st->dni = $dni[$i];
            $st->user_id = $fak->unique()->numberBetween(1,10);
            $st->birthdate = $fak->date('Y-m-d');
            $st->phone = $fak->numberBetween(100000000,999999999);
            $st->area = $studies[$fak->numberBetween(0,1)];
            $st->aptitudes = $fak->paragraph(3);
            $st->save();
        }
    }
}
