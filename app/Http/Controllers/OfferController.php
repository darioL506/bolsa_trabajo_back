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
    public function index($id)
    {
        // return Offer::all()->offerArea;
        $offer = \DB::table('offers')
            ->join('areas', 'offers.area_id', '=', 'areas.id')
            ->select(
                'offers.id',
                'offers.vacant',
                'offers.name',
                'offers.description',
                'offers.startDate',
                'offers.endDate',
                'offers.area_id',
                'offers.isActive',
                'areas.description as area_description'
            )
            ->where('offers.company_id', '=', $id)
            ->get();

        return $offer;
    }

    // Método que devuelve todas las ofertas y que pertenecen a un area.
    public function indexById($id)
    {
        // return Offer::all()->offerArea;
        $offer = \DB::table('offers')
            ->join('areas', 'offers.area_id', '=', 'areas.id')
            ->select(
                'offers.id',
                'offers.vacant',
                'offers.name',
                'offers.description',
                'offers.startDate',
                'offers.endDate',
                'offers.area_id',
                'offers.isActive',
                'areas.description as area_description'
            )
            ->where('offers.company_id', '=', $id)
            ->get();

        return $offer;
    }

    // Método para mostar una oferta
    public function show($oferta)
    {
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
    public function store(Request $request)
    {
        // $offer = Offer::create($request->all());

        // Otra forma de hacerlo
        $name = $request->get('name');
        $vacant = $request->get('vacant');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $description = $request->get('description');
        $company_id = $request->get('company_id');

        // Recupero el nombre del area para sacar el id del area
        $areaDescription = $request->get('areaDescription');
        $area = AreaController::getAreaId($areaDescription);
        $area_id = $area[0]->id;

        $o = new \App\Models\Offer;
        $o->name = $name;
        $o->vacant = $vacant;
        $o->startDate = $startDate;
        $o->endDate = $endDate;
        $o->description = $description;
        $o->company_id = $company_id;
        $o->area_id = $area_id;
        $message = 'Inserción ok';
        $o->save();
        /*try {
        } catch (\Exception $e) {
            $message = $e;
        }*/

        return response()->json(['code' => 201, 'message' => $message . $o], 201);
    }

    // Método para actualizar una oferta
    public function update(Request $request, $offer)
    {
        // Comprobamos si la oferta existe.
        $offer = Offer::find($offer);

        // Si no existe esa oferta devolvemos un error.
        if (!$offer) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra una oferta con ese código.'])], 404);
        }

        // $offer->update($request->all());

        // Otra forma de hacerlo
        $id = $request->get('id');
        $name = $request->get('name');
        $vacant = $request->get('vacant');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $description = $request->get('description');

        // Recupero el nombre del area para sacar el id del area
        $areaDescription = $request->get('areaDescription');
        $area = AreaController::getAreaId($areaDescription);
        $area_id = $area[0]->id;

        // Se guarda todo en la base de datos de oferta
        \DB::table('offers')
            ->where('id', $id)
            ->update(['name' => $name, 'vacant' => $vacant, 'startDate' => $startDate, 'endDate' => $endDate, 'description' => $description, 'area_id' => $area_id]);

        return response()->json($offer, 200);
    }

    // Método para borrar oferta
    public function delete($offer)
    {
        // Comprobamos si la oferta existe.
        $offer = Offer::find($offer);

        // Si no existe esa oferta devolvemos un error.
        if (!$offer) {

            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un artículo con ese código ' . $offer])], 404);
        }

        $offer->delete();

        return response()->json(['code' => 200, 'message' => 'Artículo ' . $offer . ' borrado.'], 200);
    }

    // Método para activa una oferta
    public function activeOffer($id)
    {
        // Comprobamos si la oferta existe.
        $offer = Offer::find($id);
        // Si no existe esa oferta devolvemos un error.
        if (!$offer) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra una oferta con ese código.'])], 404);
        }
        // Actualizo
        Offer::where('id', '=', $id)
            ->update(['isActive' => 1]);
        return response()->json($offer, 200);
    }

    // Método para activa una oferta
    public function desactiveOffer($id)
    {
        // Comprobamos si la oferta existe.
        $offer = Offer::find($id);
        // Si no existe esa oferta devolvemos un error.
        if (!$offer) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra una oferta con ese código.'])], 404);
        }
        // Actualizo
        Offer::where('id', '=', $id)
            ->update(['isActive' => 0]);
        return response()->json($offer, 200);
    }
}
