<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Offer;
use Illuminate\Http\Request;

class InterviewController extends Controller
{

    public function newInterview(Request $request)
    {
        $inter = new Interview();
        $offerId = $request->get('offerId');

        $offer = Offer::where('id', $offerId)->first();

        if (!$offer) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el oferta con ese código.'])], 404);
        }

        $inter->student_id = $request->get('studentId');
        $inter->offer_id = $offerId;
        $inter->Joined_by = $request->get('sended');

        $inter->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $inter], 201);
    }

    public function unsubscribe(Request $request)
    {
        $inter = Interview::where('id', $request->get('interviewId'))->first();
    }

    public function getStudentInterview($studentId)
    {

        $interviews = Interview::where('student_id', $studentId)->get();

        if (!$interviews) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Error al buscar'])], 404);
        }

        return response()->json(['code' => 201, 'message' => 'Datos recogidos: ', 'data' => $interviews], 201);
    }

    public function unsubInter($interId)
    {

        $inter = Interview::where('id', $interId)->first();

        if (!$inter) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Error al buscar'])], 404);
        }

        $inter->isActive = 2;
        $inter->save();

        return response()->json(['code' => 201, 'message' => 'Datos eliminados: ', 'data' => $inter], 201);
    }
    public function gestInterview(Request $request)
    {
        $interview_id = $request->get('interview_id');
        $isActive=$request->get('isActive');
        $inter = Interview::where('id', $interview_id)->first();
        if (!$inter) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Error al buscar'])], 404);
        }

            $inter->isActive = $isActive;
            $inter->save();
    }

    public function acpetInter($interId)
    {

        $inter = Interview::where('id', $interId)->first();

        if (!$inter) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Error al buscar'])], 404);
        }

        $inter->isActive = 1;
        $inter->save();

        return response()->json(['code' => 201, 'message' => 'Datos eliminados: ', 'data' => $inter], 201);
    }
}
