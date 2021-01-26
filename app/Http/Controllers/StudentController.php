<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function insertStudents(Request $request) {

        //$json = json_decode($request->all());
        $student = Student::create($request->all());

        /*$st = new Student();
        $st->name = $request->get('name');
        $st->lastnames = $request->get('lastnames');
        $st->dni = $request->get('dni');
        $st->dni = $request->get('birthdate');
        $st->area = $request->get('area');
        $st->aptitudes = $request->get('aptitudes');*/

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $student], 201);

    }
}
