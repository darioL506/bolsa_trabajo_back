<?php

namespace App\Http\Controllers;

use App\Models\StudentArea;
use Illuminate\Http\Request;

class StudentAreaController extends Controller
{
    public function index()
    {
        return StudentArea::all();
    }
    public static function getAreabyUserId($id)
    {
        return $area_id = StudentArea::select('area_id')
            ->join('areas', 'areas.id', '=', 'student_areas.area_id')
            ->select('areas.description')
            ->where('student_areas.user_id', '=', $id)
            ->get();
    }
    // Método para coger el id de un area por su descripcion
    public static function getAreabyAreaId($id)
    {
        return $user_id = StudentArea::select('user_id')->where('area_id', $id)->get();
    }
}
