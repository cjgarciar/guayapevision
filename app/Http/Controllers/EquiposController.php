<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;

class EquiposController extends Controller
{
    public function guardar_equipos(Request $request){
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $accion = $request->accion;
        $msgError = null;
        $msgSuccess = null;

        try {

            DB::SELECT("
            INSERT INTO equipos(nombre, descripcion) values (:nombre, :descripcion)
            ", ["nombre"=>$nombre, "descripcion"=>$descripcion]);

            $msgSuccess = "Equipo guardado con exito";

        } catch (Exception $e) {
            $msgError = "Error al guardar: ".$e->getMessage();
        }

        return response()->json([
            'message' => $msgSuccess
        ]);
    }
}
