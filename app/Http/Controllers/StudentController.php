<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DateTime;

class StudentController extends Controller
{
    public function insertStudents(Request $request) {
        
        $st = new Student();
        $st->name = $request->get('name');
        $st->lastnames = $request->get('lastName');
        $st->dni = $request->get('dni');
        $st->birthdate = implode("-",$request->get('birthdate'));
        $st->area = $request->get('area');
        $st->aptitudes = $request->get('aptitudes');
        $st->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $st ], 201);

    }
}
