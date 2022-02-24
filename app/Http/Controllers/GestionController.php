<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestionController extends Controller
{
    static public function isAdmin(){  
        if (auth()->user() == true) {
            if(Auth::user()->hasRole("administrador")){
                return true;
            }
        }
        abort(401);
        
    }

    static public function isAuth(){
        $autenticado = auth()->user();
        
        if ($autenticado == false) {
            abort(401);
        }
        return true;
        
        
    }
}
