<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentController;
use App\Models\User;
use App\Models\UserRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserRolesController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CompanyController;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // REGISTRO
        if (User::where('email', $request->get('email'))->count() == 1) {
            return response()->json(['message' => 'Registro incorrecto. Revise las credenciales.', 'code' => 400], 400);
        }

        $validatedData = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        $userRol = new UserRol();

        $rol = 0;
        if ($request->get('condicion') == 'superadmin') {
            $rol = 1;
        } elseif ($request->get('condicion') == 'admin') {
            $rol = 2;
        } elseif ($request->get('condicion') == 'student') {
            $rol = 3;
        } elseif ($request->get('condicion') == 'company') {
            $rol = 4;
        }

        $userRol->user_id = $user->id;
        $userRol->rol_id = $rol;
        $userRol->save();

        return response()->json(['message' => ['user' => $user, 'access_token' => $accessToken], 'code' => 201], 201);
    }

    //LOGIN
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json(['message' => 'Login incorrecto. Revise las credenciales.', 'code' => 400], 400);
        }
        // Creo el token de acceso para el usuario
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        // Recuperamos el rol_id del usuario
        $us = auth()->user();
        if ($us->isActive === 1) {
            $rol = UserRolesController::getRol($us->id);
            if ($rol->rol_id === 4) {
                $company = CompanyController::getCompany($us->id);
                return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken, 'rol' => $rol->rol_id, 'company_id' => $company->id, 'name' => $company->name], 'code' => 200], 200);
            } elseif ($rol->rol_id == 3) {
                $student = StudentController::getStudent($us->id);
                return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken, 'rol' => $rol->rol_id, 'student_id' => $student->id, 'name' => $student->name, 'lastnames' => $student->lastnames], 'code' => 200], 200);
            } else {
                return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken, 'rol' => $rol->rol_id], 'code' => 200], 200);
            }
            return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken, 'rol' => $rol->rol_id], 'code' => 200], 200);
        } else {
            return response()->json(['message' => 'Usuario desactivado,contacte con el administrador', 'code' => 400], 400);
        }
    }
    public function getAll()
    {
        $data = json_encode(User::all());
        return response()->json($data, 200);
    }

    public function delete($userId)
    {
        $user = User::where('id', $userId)->first();

        // Si no existe esa oferta devolvemos un error.
        if (!$user) {

            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra el usuario indicado ' . $user])], 404);
        }

        $user->delete();

        return response()->json(['code' => 200, 'message' => 'Usuario ' . $user . ' borrado.'], 200);
    }

    public function update(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();

        // Si no existe esa oferta devolvemos un error.
        if (!$user) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra el usuario indicado ' . $user])], 404);
        }

        $user->email = $request->get('email');

        $password = Hash::make($request->get('password'));

        $user->id = $request->get('id');
        $user->password = $password;

        $user->save();

        return response()->json(['code' => 200, 'message' => 'Usuario ' . $user . ' actualizado.'], 200);
    }

    public function activate(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();

        if (!$user) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra el usuario indicado ' . $user])], 404);
        }

        $user->isActive = $request->get('activate');

        $user->save();

        return response()->json(['code' => 200, 'message' => 'Usuario ' . $user . ' actualizado.'], 200);
    }
}
