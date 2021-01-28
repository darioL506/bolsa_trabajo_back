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

    // Método que devuelve todas las ofertas
    public function index() {
         return Offer::all();
    }

    // Método para mostar una oferta
    public function show($oferta) {
        // Comprobamos si la oferta existe existe.
        $oferta = Offer::find($oferta);

        // Si no existe esa oferta devolvemos un error.
        if (!$oferta) {
            return response()->json(['code' => 404, 'message' => 'No se encuentra un artículo con ese código ' . $oferta], 404);
        }

        //return oferta;
        return response()->json(['code' => 200, 'message' => $oferta], 200);
    }

    // Método para guardar una nueva oferta
    public function store(Request $request) {
        $offer = Offer::create($request->all());
        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $offer], 201);
        //return response()->json($article, 201);
    }

}
