<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Http\Request;
use App\Models\Student;
use DateTime;
use PHPUnit\Util\Json;

class StudentController extends Controller
{
    public function insertStudents(Request $request) {
        
        $st = new Student();
        $st->name = $request->get('name');
        $st->lastnames = $request->get('lastName');
        $st->dni = $request->get('dni');
        $st->user_id = $request->get('user_id');
        $st->birthdate = implode("-",$request->get('birthdate'));
        $st->phone = $request->get('phone');
        $st->area = $request->get('area');
        $st->aptitudes = $request->get('aptitudes');
        $st->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $st ], 201);

    }

    public function updateStudents(Request $request, $student) {

        $alumno = Student::find($student);

        if (!$alumno) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el alumno con ese código.'])], 404);
        }

        $alumno->name = $request->get('name');
        $alumno->lastnames = $request->get('lastName');
        $alumno->dni = $request->get('dni');
        $alumno->user_id = $request->get('user_id');
        $alumno->birthdate = implode("-",$request->get('birthdate'));
        $alumno->phone = $request->get('phone');
        $alumno->area = $request->get('area');
        $alumno->aptitudes = $request->get('aptitudes');

        $alumno->save();
        //return response()->json(['status'=>'ok','data'=>$fabricante],200);
        return response()->json($alumno, 200);
    }
    public function deleteStudent($student) {

        $alumno = Student::find($student);


        if (!$alumno) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un artículo con ese código ' . $alumno])], 404);
        }

        $alumno->delete();

        return response()->json(['code' => 200, 'message' => 'Alumno ' . $alumno . ' borrado.'], 200);
    }

    public function getAll() {
        $data = json_encode(Student::all());
        return response()->json($data,200);
    }

    public function get($student) {
        $alumno = Student::find($student);
        if(!$alumno) {
            return response()->json(['code' => 404, 'message' => 'No se encuentra el alumno ' . $student], 404);
        }
        $data = json_encode($alumno);
        return response()->json(['code' => 200, $data], 200);
    }
}


