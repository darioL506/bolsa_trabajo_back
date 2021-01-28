<?php

namespace App\Http\Controllers;
use App\Models\Offer;

use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function index() {
         return Offer::all();
     }
}
