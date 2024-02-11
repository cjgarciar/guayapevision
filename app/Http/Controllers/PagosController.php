<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;


class PagosController extends Controller
{

    public function ver_pagos(){

        
        $pagos = DB::SELECT("
            SELECT PP.ID, PP.ID_USER, U.USERNAME,E.nombre||' - '||e2.NOMBRE PARTIDO, ' L. '||cp.PRECIO precio , PP.CREATED_AT::date FECHA_PAGO  FROM pagos_partidos pp
            JOIN USERS U ON U.id = pp.id_user
            JOIN CALENDARIO_PARTIDOS CP ON CP.id = pp.id_calendario_partido
            JOIN EQUIPOS E ON E.id = CP.id_equipo
            JOIN EQUIPOS E2 ON E2.id = CP.id_equipo_2
            WHERE PP.DELETED_AT IS NULL
            AND CP.deleted_at IS NULL
            AND E.DELETED_AT IS NULL
            AND E2.DELETED_AT IS NULL
        ");


        return response()->json([
            'message' => 'Pagos Cargados Con Exito!',
            'pagos' => $pagos
        ]);
    }

    public function guardar_pagos(Request $request){
        $id = $request->id;
        $id_user = Auth::user()->id;
        $id_calendario_partido = $request->id_calendario_partido;
        $accion = $request->accion;
        $username = $request->username;
        $msgError = null;
        $msgSuccess = null;

        if ($id == null && $accion == 2) {
            $accion = 1;
        }

        try {

            if ($accion == 1) {
               
               $insert_pagos_partidos = DB::SELECT("
                INSERT INTO pagos_partidos(id_user, id_calendario_partido) values (:nombre, :descripcion) 
                RETURNING  id
                ", ["id_user"=>$id_user, "id_calendario_partido"=>$id_calendario_partido]);

                foreach ($insert_pagos_partidos as $r) {
                    $id = $r->id;
                }

                $msgSuccess = "Pago Realizado Con Exito!";

            } /*else if ($accion == 2) {

                $sql_turnos = DB::select(
                    "update pagos_partidos set 
                     updated_at=now(),nombre=:nombre,descripcion=:descripcion 
                     where id=:id 
                    ",
                    ['id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion]
                );
                $msgSuccess = "Equipo Actualizado Exitosamente!";

            }*/ else if ($accion == 3) {

                $sql_turnos = DB::select(
                    "update pagos_partidos set deleted_at=now() where 
                     id=:id 
                    ",
                    ['id' => $id]
                );

                $msgSuccess = "Pago Eliminado con Exito!";

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
