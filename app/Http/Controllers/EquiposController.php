<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Exception;


class EquiposController extends Controller
{
    public function ver_equipos(){

        $equipos = DB::SELECT('
            select id, upper(nombre) title, 1 "userId"  from equipos 
            where deleted_at is null
            order by nombre
        ');

        return response()->json(
              $equipos
        );
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
            'mensaje' => $msgSuccess,
            'error' => $msgError,
            'estatus'=>true
        ]);
    }


    public function ver_calendario_equipos(Request $request){        
        $calendario_partidos = null;
        $accion = $request->accion;
        $msgError = null;
        $msgSuccess = null;
        $id_user = Auth::user()->id;
        //$id_user = 1;

        try {

            $calendario_partidos = DB::SELECT("select cp.id, cp.id_equipo, upper(e.nombre) as equipo, cp.id_equipo_2, upper(e2.nombre) as equipo_2,
            upper(e.nombre)||' vs '||upper(e2.nombre) encuentro,
            cp.precio, to_char(cp.fecha_hora_inicio, 'DD/MM/YYYY HH:MI AM') fecha_hora_inicio,
            to_char(cp.fecha_hora_fin, 'DD/MM/YYYY HH:MI AM') fecha_hora_fin, pp.id_user,
            case when pp.id_calendario_partido is not null then true else false end as pago_partido,
            tcp.clientid, tcp.secretkey
            from public.calendario_partidos cp
            join equipos e on e.id = cp.id_equipo
            join equipos e2 on e2.id = cp.id_equipo_2
            left join public.pagos_partidos pp on pp.id_calendario_partido = cp.id and pp.id_user = :id_user and pp.deleted_at is null
            join public.tbl_cuenta_paypal tcp on true
            where cp.deleted_at is null
            and cp.fecha_hora_inicio::date >= (current_date at time zone 'CST')             
            ",
        [
            'id_user'=>$id_user
        ]);

            $msgSuccess = "Equipo guardado con exito";

        } catch (Exception $e) {
            $msgError = "Error al guardar: ".$e->getMessage();
        }

        return response()->json([
            'calendario_partidos' => $calendario_partidos
        ]);
    }
}


