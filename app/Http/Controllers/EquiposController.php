<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;

class EquiposController extends Controller
{
    public function ver_equipos(){

        $quipos = DB::SELECT("
            select id, nombre, descripcion from equipos 
            where deleted_at is null
            order by nombre
        ");

        return response()->json([
            'message' => $msgSuccess, 'equipos'=> $equipos
        ]);
    }

    public function guardar_equipos(Request $request){
        $id = $request->id;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $accion = $request->accion;
        $msgError = null;
        $msgSuccess = null;

        if ($id == null && $accion == 2) {
            $accion = 1;
        }

        try {

            if ($accion == 1) {
               
               $insert_equipos = DB::SELECT("
                INSERT INTO equipos(nombre, descripcion) values (:nombre, :descripcion) 
                RETURNING  id
                ", ["nombre"=>$nombre, "descripcion"=>$descripcion]);

                foreach ($insert_equipos as $r) {
                    $id = $r->id;
                }

                $msgSuccess = "Equipo Guardado Con Exito!";

            } else if ($accion == 2) {

                $sql_turnos = DB::select(
                    "update equipos set 
                     updated_at=now(),nombre=:nombre,descripcion=:descripcion 
                     where id=:id 
                    ",
                    ['id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion]
                );
                $msgSuccess = "Equipo Actualizado Exitosamente!";

            } else if ($accion == 3) {

                $sql_turnos = DB::select(
                    "update equipos set deleted_at=now() where 
                     id=:id 
                    ",
                    ['id' => $id]
                );

                $msgSuccess = "Equipo Eliminado con Exito!";

            } else {
                $msgError = "Accion invalida";
            }

            

        } catch (Exception $e) {
            $msgError = "Error al guardar: ".$e->getMessage();
        }

        return response()->json([
            'message' => $msgSuccess
        ]);
    }
}


