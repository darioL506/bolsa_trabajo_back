<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserRolesController;


class AuthController extends Controller
{
    //
    public function register(Request $request) {

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

        return response()->json(['message' => ['user' => $user, 'access_token' => $accessToken], 'code' => 201], 201);
    }

    public function login(Request $request) {
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
        $rol = UserRolesController::getRol($us->id);

        return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken, 'rol' => $rol->rol_id ], 'code' => 200], 200);
    }
}