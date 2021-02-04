<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // public function insertStudents(Request $request): \Illuminate\Http\JsonResponse
    // {

    //     $cp = new Company();
    //     //$cp->user_id = $request->get('user_id');
    //     $cp->cif = $request->get('cif');
    //     $cp->name = $request->get('name');
    //     $cp->foundation = implode("-", $request->get('foundation'));
    //     $cp->section = $request->get('section');
    //     $cp->description = $request->get('description');
    //     $cp->save();


    //     return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $cp], 201);

    // }

    // public function updateCompany(Request $request, $company): \Illuminate\Http\JsonResponse
    // {

    //     $comp = Company::find($company);

    //     if (!$comp) {
    //         return response()->json(['errors' => array(['code' => 404, 'message' => 'No existe el alumno con ese código.'])], 404);
    //     }

    //     $comp->name = $request->get('name');
    //     $comp->lastnames = $request->get('lastName');
    //     $comp->dni = $request->get('dni');
    //     $comp->birthdate = implode("-", $request->get('birthdate'));
    //     $comp->phone = $request->get('phone');
    //     $comp->area = $request->get('area');
    //     $comp->aptitudes = $request->get('aptitudes');

    //     $comp->save();
    //     //return response()->json(['status'=>'ok','data'=>$fabricante],200);
    //     return response()->json($comp, 200);
    // }

    // public function deleteCompany($company): \Illuminate\Http\JsonResponse
    // {

    //     $comp = Student::find($company);


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
    public function getCompanyId($user_id)
    {
        $company = Company::where('user_id', $user_id)->first();;
        if (!$company) {
            return response()->json(['code' => 404, 'message' => 'No se encuentra el alumno ' . $company], 404);
        }
        $data = json_encode($company);
        return response()->json(['code' => 200, $data], 200);
    }
}

