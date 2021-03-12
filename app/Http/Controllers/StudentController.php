<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\StudentArea;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Http\Request;
use App\Models\Student;
use DateTime;
use PHPUnit\Util\Json;

class StudentController extends Controller
{
    public function getAreas($user_Id)
    {
        $data = json_encode(StudentArea::getAreabyUserId($user_Id));
        return response()->json($data, 200);
    }
    public function insertStudents(Request $request)
    {
        $id = $request->get('id');

        $st = new Student();
        $st->name = $request->get('name');
        $st->lastnames = $request->get('lastName');
        $st->dni = $request->get('dni');
        $st->user_id = $id;
        $st->birthdate = implode("-", $request->get('birthdate'));
        $st->phone = $request->get('phone');
        $st->aptitudes = $request->get('aptitudes');
        $st->status = $request->get('status');
        $st->save();

        $areas = $request->get('areas');

        foreach ($areas as $area) {
            $stAr = new StudentArea();
            $stAr->user_id = $id;
            $stAr->area_id = $area;
            $stAr->save();
        }

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $st], 201);
    }

    public function updateStudent(Request $request, $user_Id)
    {
        $alumno = Student::where('user_id', $user_Id)->first();

        if (!$alumno) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el alumno con ese código.'])], 404);
        }

        $alumno->name = $request->get('name');
        $alumno->lastnames = $request->get('lastName');
        $alumno->dni = $request->get('dni');
        $alumno->birthdate = implode("-", $request->get('birthdate'));
        $alumno->phone = $request->get('phone');
        $alumno->aptitudes = $request->get('aptitudes');
        $alumno->status = $request->get('status');

        $alumno->save();

        $stAr = StudentArea::where('user_id', $user_Id)->delete();

        $areas = $request->get('areas');

        foreach ($areas as $area) {
            $stAr = new StudentArea();
            $stAr->user_id = $user_Id;
            $stAr->area_id = $area;
            $stAr->save();
        }

        return response()->json(['code' => 200, 'message' => 'Alumno ' . $alumno . ' actualizado.','data'=>$data], 200);
    }
    public function deleteStudent($student)
    {

        $alumno = Student::find($student);


        if (!$alumno) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un artículo con ese código ' . $alumno])], 404);
        }

        $alumno->delete();

        return response()->json(['code' => 200, 'message' => 'Alumno ' . $alumno . ' borrado.'], 200);
    }

    public function getAll()
    {
        $data = json_encode(\DB::table('student_areas')
            ->join('areas', 'student_areas.area_id', '=', 'areas.id')
            ->join('students', 'students.user_id', '=', 'student_areas.user_id')
            ->join('users','users.id','=','student_areas.user_id')
            ->get());
        return response()->json($data, 200);
    }

    public function getAcepted($company_id)
    {

        $data = json_encode(\DB::table('offers')
        ->join('interviews', 'interviews.offer_id', '=', 'offers.id')
        ->join('students', 'students.id', '=', 'interviews.student_id')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->where('offers.company_id','=',$company_id)
        ->where('interviews.isActive', '=', 2)
        ->get(['offers.name AS offer_name','students.*','interviews.*','users.*']));
        return response()->json($data, 200);
    }
    public function waitInter($company_id)
    {

        $data = json_encode(\DB::table('offers')
        ->join('interviews', 'interviews.offer_id', '=', 'offers.id')
        ->join('students', 'students.id', '=', 'interviews.student_id')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->where('offers.company_id', '=', $company_id)
            ->where('interviews.isActive', '=', 0)
            ->get(['offers.name AS offer_name', 'students.*', 'interviews.*', 'users.*']));
        return response()->json($data, 200);
    }

    public static function get($user_Id)
    {
        $alumno = Student::where('user_id', $user_Id)->first();
        if (!$alumno) {
            return response()->json(['code' => 404, 'message' => 'No se encuentra el alumno ' . $alumno], 404);
        }
        $data = json_encode($alumno);
        return response()->json(['code' => 200, $data], 200);
    }

    public static function getStudent($user_id)
    {
        return $student = Student::where('user_id', $user_id)->first();
    }
}
