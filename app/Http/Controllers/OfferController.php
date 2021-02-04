<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\OfferAreaController;

class OfferController extends Controller
{

    public function offer(Request $request)
    {
        return response()->json($request->offer());
    }

    // Método que devuelve todas las ofertas y el area a la que pertenecen
    public function index() {
         // return Offer::all()->offerArea;
         // return OfferArea::with(['offerArea'])->get();
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
        // $offer = Offer::create($request->all());

        // Otra forma de hacerlo
        $name = $request->get('name');
        $vacant = $request->get('vacant');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $description = $request->get('description');
        $company_id = $request->get('company_id');

        $o = new \App\Models\Offer;
        $o->name = $name;
        $o->vacant = $vacant;
        $o->startDate = $startDate;
        $o->endDate = $endDate;
        $o->description = $description;
        $o->company_id = $company_id;
        try {
            $o->save();
        } catch (\Exception $e) {
            $mensaje = 'Error al insertar la oferta';
        }

         // Recupero el nombre del area para sacar el id del area
        $areaDescription = $request->get('areaDescription');
        $area_id = AreaController::getAreaId($areaDescription);

        // Recupero el id de la última oferta de la empresa
        $offer_id = Offer::max('id');

        // Inserto en la tabla offer area
        OfferAreaController::store($offer_id, $area_id);

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $o], 201);

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

    public static function getLastId($company_id){

    }

}
