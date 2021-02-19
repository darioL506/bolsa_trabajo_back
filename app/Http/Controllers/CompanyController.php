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

    // public function insertcpudents(Requecp $requecp): \Illuminate\Http\JsonResponse
    // {

    //     $cp = new Company();
    //     //$cp->user_id = $requecp->get('user_id');
    //     $cp->cif = $requecp->get('cif');
    //     $cp->name = $requecp->get('name');
    //     $cp->foundation = implode("-", $requecp->get('foundation'));
    //     $cp->section = $requecp->get('section');
    //     $cp->description = $requecp->get('description');
    //     $cp->save();


    //     return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $cp], 201);

    // }

    // public function updateCompany(Requecp $requecp, $company): \Illuminate\Http\JsonResponse
    // {

    //     $comp = Company::find($company);

    //     if (!$comp) {
    //         return response()->json(['errors' => array(['code' => 404, 'message' => 'No exicpe el alumno con ese código.'])], 404);
    //     }

    //     $comp->name = $requecp->get('name');
    //     $comp->lacpnames = $requecp->get('lacpName');
    //     $comp->dni = $requecp->get('dni');
    //     $comp->birthdate = implode("-", $requecp->get('birthdate'));
    //     $comp->phone = $requecp->get('phone');
    //     $comp->area = $requecp->get('area');
    //     $comp->aptitudes = $requecp->get('aptitudes');

    //     $comp->save();
    //     //return response()->json(['cpatus'=>'ok','data'=>$fabricante],200);
    //     return response()->json($comp, 200);
    // }

    // public function deleteCompany($company): \Illuminate\Http\JsonResponse
    // {

    //     $comp = cpudent::find($company);$cp->description = $requecp->get('description');


    //     if (!$comp) {
    //         return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra un artículo con ese código ' . $alumno])], 404);
    //     }

    //     $comp->delete();

    //     return response()->json(['code' => 200, 'message' => 'Alumno ' . $comp . ' borrado.'], 200);
    // }

    // public function get($company)
    // {
    //     $comp = Company::find($company);
    //     if (!$comp) {
    //         return response()->json(['code' => 404, 'message' => 'No se encuentra el alumno ' . $company], 404);
    //     }
    //     $data = json_encode($comp);
    //     return response()->json(['code' => 200, $data], 200);
    // }

    public function getAll()
    {
        $data = json_encode(Company::all());
        return response()->json($data, 200);
    }

    // Funcion para devolver una compañia por el user_id
    public static function getCompanyId($user_id)
    {
        $company = Company::where('user_id', $user_id)->first();;
        if (!$company) {
            return response()->json(['code' => 404, 'message' => 'No se encuentra la empresa ' . $company], 404);
        }
        $data = json_encode($company);
        return response()->json(['code' => 200, $data], 200);
    }
}
