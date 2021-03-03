<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Offer;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function newInterview(Request $request) {
        $inter = new Interview();
        $offerId = $request->get('offerId');

        $offer = Offer::where('id', $offerId)->first();

        if (!$offer) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el oferta con ese código.'])], 404);
        }

        $vacants = $offer->vacant;

        $vacants--;

        $offer->vacant = $vacants;

        $inter->student_id = $request->get('studentId');
        $inter->offer_id = $offerId;
        $inter->Joined_by = $request->get('sended');

        $inter->save();
        $offer->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $inter ], 201);
    }

    public function unsubscribe(Request $request) {
        $inter = Interview::where('id', $request->get('interviewId'))->first();
    }

    public function getStudentInterview($studentId) {

        $interviews = Interview::where('student_id',$studentId)->get();

        if (!$interviews) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Error al buscar'])], 404);
        }

        return response()->json(['code' => 201, 'message' => 'Datos recogidos: ', 'data' => $interviews ], 201);
    }
}
