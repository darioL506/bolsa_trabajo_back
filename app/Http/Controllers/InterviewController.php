<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function newInterview(Request $request) {
        $inter = new Interview();

        $inter->student_id = $request->get('studentId');
        $inter->offer_id = $request->get('offerId');
        $inter->send_to = $request->get('sended');

        $inter->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $inter ], 201);
    }

    public function getStudentInterview($studentId) {

        $interviews = Interview::where('student_id',$studentId)->get();

        if (!$interviews) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Error al buscar'])], 404);
        }

        return response()->json(['code' => 201, 'message' => 'Datos recogidos: ', 'data' => $interviews ], 201);
    }
}
