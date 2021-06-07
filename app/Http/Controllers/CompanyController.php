<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function insertCompany(Request $request)
    {
        $id = $request->get('id');
        $cif = $request->get('dni');

        if (Student::where('cif', $cif)->count() == 1) {
            User::where('id',$id)->delete();
            return response()->json(['message' => 'Registro incorrecto. Revise las credenciales.', 'code' => 400], 400);
        }

        $cp = new Company();
        $cp->user_id = $id;
        $cp->cif = $cif;
        $cp->foundation = implode("-", $request->get('birthdate'));
        $cp->name = $request->get('name');
        $cp->section = $request->get('sector');
        $cp->description = $request->get('description');
        $cp->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados: ' . $cp], 201);
    }

    public function getAllStudents()
    {
        $data = json_encode(Student::all());
        return response()->json($data, 200);
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
        return $company = Company::where('user_id', $user_id)->first();
    }

    // Funcion para devolver una compañia por el company_id
    public static function getCompanyById($company_id)
    {
        return $company = Company::where('id', $company_id)->first();
    }
}
