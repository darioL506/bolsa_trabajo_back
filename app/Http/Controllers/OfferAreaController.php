<?php

namespace App\Http\Controllers;
use App\Models\OfferArea;

use Illuminate\Http\Request;

class OfferAreaController extends Controller
{
    // Método para insertar
    public static function store($offer_id, $area_id) {
        $o = new \App\Models\Offer;
        $o->offer_id = $offer_id;
        $o->area_id = $area_id;
        try {
            $o->save();
        } catch (\Exception $e) {
            $mensaje = 'Error al insertar';
        }
        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $o], 201);
    }
}
