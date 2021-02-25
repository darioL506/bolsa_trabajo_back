<?php

namespace App\Http\Controllers;

use App\Models\Area;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    // Método que devuelve todas las ofertas y el area a la que pertenecen
    public function index()
    {
        return Area::all();
    }
    public function getAreabyId($id)
    {
        return $areas = Area::select('description')->where('id', $id)->get();
    }
    // Método para coger el id de un area por su descripcion
    public static function getAreaId($areaDescription)
    {

        return $id = Area::select('id')->where('description', $areaDescription)->get();
    }
}
