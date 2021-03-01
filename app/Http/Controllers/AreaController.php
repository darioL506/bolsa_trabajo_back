<?php

namespace App\Http\Controllers;
use App\Models\Area;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    // Método que devuelve todas las ofertas y el area a la que pertenecen
    public function index() {
        return Area::all();
   }

   // Método para coger el id de un area por su descripcion
   public static function getAreaId($areaDescription){

    return $id = Area::select('id')->where('description', $areaDescription)->get();

   }

   public function delete($areaId) {

       $area = Area::find($areaId);


       if (!$area) {
           return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un ciclo con ese código ' . $area])], 404);
       }

       $area->delete();

       return response()->json(['code' => 200, 'message' => 'Area ' . $area . ' borrado.'], 200);

   }

    public function newArea(Request $request) {
        $area = new Area();
        $area->description = $request->get('nombre');
        $area->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $area ], 201);
    }

    public function update($areaId, Request $request){
        $area = Area::find($areaId);

        if (!$area) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un ciclo con ese código ' . $area])], 404);
        }

        $area->description = $request->get('nombre');
        $area->save();

        return response()->json(['code' => 201, 'message' => 'Datos actualizados: ' . $area ], 201);
    }

}
