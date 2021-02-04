<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Models\OfferArea;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function offer(Request $request)
    {
        return response()->json($request->offer());
    }

    // Método que devuelve todas las ofertas y el area a la que pertenecen
    public function index() {
         // return Offer::all()->offerArea;
         //return OfferArea::with(['offerArea'])->get();
         $offer= \DB::table('offers')
                ->join('offer_areas', 'offer_areas.offer_id', '=', 'offers.id')
                ->join('areas', 'areas.id', '=', 'offer_areas.area_id')
                ->select('offers.id', 'offers.vacant', 'offers.name', 'offers.description', 'offers.startDate', 'offers.endDate',
                            'offer_areas.area_id', 'areas.description as area_description')
                ->get();

        return $offer;
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
    }

    // Método para actualizar una oferta
    public function update(Request $request, $offer) {
        // Comprobamos si la oferta existe.
        $offer = Offer::find($offer);

        // Si no existe esa oferta devolvemos un error.
        if (!$offer) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra una oferta con ese código.'])], 404);
        }

        $offer->update($request->all());

        return response()->json($offer, 200);
    }

    // Método para borrar oferta
    public function delete($offer) {
        // Comprobamos si la oferta existe.
        $offer = Offer::find($offer);

        // Si no existe esa oferta devolvemos un error.
        if (!$offer) {

            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un artículo con ese código ' . $offer])], 404);
        }

        $offer->delete();

        return response()->json(['code' => 200, 'message' => 'Artículo ' . $offer . ' borrado.'], 200);
    }

}
