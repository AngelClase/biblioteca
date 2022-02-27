<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Prestamo;
use App\Models\Sancion;
use DateTime;

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

    static public function isPenalizado(int $user_id){
        foreach(Sancion::all() as $sancion){
            if($user_id == $sancion->user_id){
                $sancionado = GestionController::aplicarRetrasoSancion($sancion);
                if($sancionado == true){
                    return true;
                }
            }
        }
        return false;
    }

    static public function calcularPenalizacion(int $user_id = -1){
        if($user_id = -1){
            foreach(Sancion::all() as $sancion){
                GestionController::aplicarRetrasoSancion($sancion);
            }
        } else {
            foreach(Sancion::all() as $sancion){
                if($user_id == $sancion->user_id){
                    GestionController::aplicarRetrasoSancion($sancion);
                }
            }
        }
    }

    static public function aplicarRetrasoSancion(Sancion $sancion){
        $fecha_actual = new DateTime(date("Y-m-d"));
        $fecha_inicio = new DateTime($sancion->fecha_inicio);

        $dias = $fecha_inicio->diff($fecha_actual);

        return ($dias->d <= $sancion->retraso);
    }
}
