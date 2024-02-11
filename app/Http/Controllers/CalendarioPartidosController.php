<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Exception;

class CalendarioPartidosController extends Controller
{
    public function ver_calendario_partidos(Request $request){
        $estatus = true;
        $calendario_partidos = DB::select("SELECT cp.id, e.nombre equipo, e2.nombre equipo2, cp.precio, concat('L',to_char(cp.precio,'FM999,999,999.00')) precio_formato,
            cp.fecha_hora_inicio, cp.fecha_hora_fin,
            to_char(cp.fecha_hora_inicio, 'DD/MM/YYYY HH:MI AM') fecha_hora_inicio_formato, to_char(cp.fecha_hora_fin, 'DD/MM/YYYY HH:MI AM') fecha_hora_fin_formato,
            cp.created_at fecha_registro, to_char(cp.created_at, 'DD/MM/YYYY HH:MI AM') fecha_registro_formato
            from calendario_partidos cp
            join equipos e ON cp.id_equipo = e.id 
            join equipos e2 ON cp.id_equipo_2 = e2.id
            where cp.deleted_at is null
            order by cp.fecha_hora_inicio");

        return response()->json([
            'estatus' => $estatus,
            'calendario_partidos' => $calendario_partidos
        ]);
    }

    public function guardar_calendario_partidos(Request $request){
        $id = $request->id;
        $equipo = $request->equipo;
        $equipo_2 = $request->equipo_2;
        $precio = $request->precio;
        $fecha_hora_inicio = $request->fecha_hora_inicio;
        $fecha_hora_fin = $request->fecha_hora_fin;
        $accion = $request->accion;
        $msgError = null;
        $msgSuccess = null;
        $estatus = false;

        if ($id == null && $accion == 2) {
            $accion = 1;
        }

        try {

            if ($accion == 1) {
               $calendario_partido = collect(\DB::select("INSERT INTO public.calendario_partidos(
                    id_equipo, id_equipo_2, precio, fecha_hora_inicio, fecha_hora_fin)
                    VALUES (:equipo, :equipo_2, :precio, :fecha_hora_inicio, :fecha_hora_fin)",
                    ["equipo" => $equipo, "equipo_2" => $equipo_2, "precio" => $precio, 
                    "fecha_hora_inicio" => $fecha_hora_inicio, "fecha_hora_fin" => $fecha_hora_fin]))->first();

                $msgSuccess = "Partido registrado exitosamente.";
                $estatus = true;
            } else if ($accion == 2) {
                DB::select("UPDATE public.calendario_partidos
                    SET id_equipo=:equipo, id_equipo_2=:equipo_2, precio=:precio, fecha_hora_inicio=:fecha_hora_inicio, fecha_hora_fin=:fecha_hora_fin, updated_at=now()
                    WHERE id = :id",
                    ["equipo" => $equipo, "equipo_2" => $equipo_2, "precio" => $precio, 
                    "fecha_hora_inicio" => $fecha_hora_inicio, "fecha_hora_fin" => $fecha_hora_fin,
                    "id" => $id]);

                $msgSuccess = "Partido editado exitosamente.";
                $estatus = true;
            } else if ($accion == 3) {
                DB::select("UPDATE public.calendario_partidos SET deleted_at=now() WHERE id = :id",
                    ["id" => $id]);

                $msgSuccess = "Partido eliminado exitosamente.";
                $estatus = true;
            } else {
                $msgError = "Acción inválida";
                $estatus = false;
            }

        } catch (Exception $e) {
            $msgError = "Error al guardar: ".$e->getMessage();
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
            'msgSuccess' => $msgSuccess,
            'msgError' => $msgError
        ]);
    }
}
