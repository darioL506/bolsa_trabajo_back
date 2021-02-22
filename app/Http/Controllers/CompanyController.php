<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function insertCompany(Request $request)
    {


        $cp = new Company();
        $cp->user_id = $request->get('id');
        $cp->cif = $request->get('cif');
        $cp->foundation = implode("-", $request->get('birthdate'));
        $cp->name = $request->get('name');
        $cp->section = $request->get('sector');
        $cp->description = $request->get('description');
        $cp->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $cp], 201);
    }


    public function updateCompany(Request $request, $user_id)
    {

        $empresa = Company::where('user_id', $user_id)->first();

        if (!$empresa) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el empresa con ese código.'])], 404);
        }

        $empresa->name = $request->get('name');
        $empresa->cif = $request->get('cif');
        $empresa->foundation = implode("-", $request->get('birthdate'));
        $empresa->sector = $request->get('section');
        $empresa->description = $request->get('description');
        $empresa->save();

        return response()->json(['code' => 200, 'message' => 'empresa ' . $empresa . ' actualizado.'], 200);
    }

    public function getAll()
    {
        $data = json_encode(Company::all());
        return response()->json($data, 200);
    }

    // Funcion para devolver una compañia por el user_id
    public static function getCompany($user_id)
    {
        return $company = Company::where('user_id', $user_id)->first();;
    }
}
