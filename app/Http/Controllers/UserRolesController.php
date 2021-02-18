<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRol;

class UserRolesController extends Controller
{
    // Método para saber los roles de un usario
    public static function getRol($user_id) {
        return $roles = UserRol::where('user_id',$user_id)->first();
    }

}
