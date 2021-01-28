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

    public  function  updateStudents(Request $request, $student) {

        $alumno = Student::find($student);

        if (!$alumno) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el alumno con ese código.'])], 404);
        }

        $alumno->name = $request->get('name');
        $alumno->lastnames = $request->get('lastName');
        $alumno->dni = $request->get('dni');
        $alumno->birthdate = implode("-",$request->get('birthdate'));
        $alumno->area = $request->get('area');
        $alumno->aptitudes = $request->get('aptitudes');

        $alumno->save();
        //return response()->json(['status'=>'ok','data'=>$fabricante],200);
        return response()->json($alumno, 200);
    }
}
