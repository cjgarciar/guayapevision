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
            and cp.fecha_hora_inicio::date = (current_date at time zone 'CST')::date             
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

    public function ver_tbl_equipos() {
        $equipos_list = DB::select("
        select e.id, e.nombre, e.descripcion from public.equipos e
           where e.deleted_at is null
           order by 1 desc 
       "
       );
       return view("configuraciones.equipos")->with("equipos_list", $equipos_list)
       ;
       }
       
       public function guardar_tbl_equipos(Request $request) {
       $id=$request->id;
       $nombre=$request->nombre;
       $descripcion=$request->descripcion;
       $msgError=null;
       $msgSuccess=null;
       $accion=$request->accion;
       $equipos_list=null;
       if($id==null && $accion==2){
                   $accion=1;
               }
       try{ 
       
       if($accion==1){
       $sql_equipos = DB::select("insert INTO public.equipos (
       descripcion,nombre
       , created_at) values (
       :descripcion,:nombre
       , (now() at time zone 'CST') )
       RETURNING  id
       ", ['descripcion'=>$descripcion,'nombre'=>$nombre
       ]
       );
       foreach($sql_equipos as $r){
       $id=$r->id;
       }
       $msgSuccess="Registro creado con el código: ".$id;
       }else if($accion==2){
       $sql_equipos = DB::select("update public.equipos set  updated_at = (now() at time zone 'CST'),
       descripcion=:descripcion,nombre=:nombre
       where id=:id
       "
       , ['descripcion'=>$descripcion,'id'=>$id,'nombre'=>$nombre]
       );
       $msgSuccess="Registro ".$id." actualizado";
       
       }else if($accion==3){
       
       $sql_equipos = DB::select("update public.equipos set deleted_at=(now() at time zone 'CST') where
       id=:id
       "
       , ['id'=>$id]
       );
       $msgSuccess="Registro ".$id." eliminado";
       
       }else if($accion==4){
       
       $sql_equipos = DB::select("update public.equipos set deleted_at=null where
       id=:id
       "
       , ['id'=>$id]
       );
       $msgSuccess="Registro ".$id." eliminado";
       
       }else{
                       $msgError="Accion invalida";
                   }
       if($msgError==null){
        $equipos_list = DB::select("select * from (
        select e.id, e.nombre, e.descripcion from public.equipos e
           where e.deleted_at is null
           order by 1 desc 
       ) x where id=:id
       ",[
       "id"=>$id
       ]);
       }
       }catch (Exception $e){
                   $msgError=$e->getMessage();
               }
       return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "equipos_list"=>$equipos_list]);
       }

       public function ver_calendario_partidos() {
        $equipo_list = DB::select("select id, nombre from public.equipos where deleted_at is null");
        $equipo_2_list = DB::select("select id, nombre from public.equipos where deleted_at is null");
        $calendario_partidos_list = DB::select("
        select cp.id, cp.id_equipo, e.nombre as equipo, cp.id_equipo_2, e2.nombre as equipo_2,		
               cp.precio, cp.fecha_hora_inicio, cp.fecha_hora_fin
               from public.calendario_partidos cp
               join equipos e on e.id = cp.id_equipo
               join equipos e2 on e2.id = cp.id_equipo_2
               where cp.deleted_at is null
           order by 1 desc 
       "
       );
       return view("configuraciones.calendarioEquipos")->with("calendario_partidos_list", $calendario_partidos_list)
       ->with("equipo_list", $equipo_list)
       ->with("equipo_2_list", $equipo_2_list)
       ;
       }
       
       public function guardar_calendario_partidos(Request $request) {
       $id=$request->id;
       $id_equipo=$request->id_equipo;
       $id_equipo_2=$request->id_equipo_2;
       $precio=$request->precio;
       $fecha_hora_inicio=$request->fecha_hora_inicio;
       $fecha_hora_fin=$request->fecha_hora_fin;
       $msgError=null;
       $msgSuccess=null;
       $accion=$request->accion;
       $calendario_partidos_list=null;
       if($id==null && $accion==2){
                   $accion=1;
               }
       try{ 
       
       if($accion==1){
       $sql_calendario_partidos = DB::select("insert INTO public.calendario_partidos (
       fecha_hora_fin,fecha_hora_inicio,id_equipo,id_equipo_2,precio
       , created_at) values (
       :fecha_hora_fin,:fecha_hora_inicio,:id_equipo,:id_equipo_2,:precio
       , (now() at time zone 'CST') )
       RETURNING  id
       ", ['fecha_hora_fin'=>$fecha_hora_fin,'fecha_hora_inicio'=>$fecha_hora_inicio,'id_equipo'=>$id_equipo,'id_equipo_2'=>$id_equipo_2,'precio'=>$precio
       ]
       );
       foreach($sql_calendario_partidos as $r){
       $id=$r->id;
       }
       $msgSuccess="Registro creado con el código: ".$id;
       }else if($accion==2){
       $sql_calendario_partidos = DB::select("update public.calendario_partidos set  updated_at = (now() at time zone 'CST'),
       fecha_hora_fin=:fecha_hora_fin,fecha_hora_inicio=:fecha_hora_inicio,id_equipo=:id_equipo,id_equipo_2=:id_equipo_2,precio=:precio
       where id=:id
       "
       , ['fecha_hora_fin'=>$fecha_hora_fin,'fecha_hora_inicio'=>$fecha_hora_inicio,'id'=>$id,'id_equipo'=>$id_equipo,'id_equipo_2'=>$id_equipo_2,'precio'=>$precio]
       );
       $msgSuccess="Registro ".$id." actualizado";
       
       }else if($accion==3){
       
       $sql_calendario_partidos = DB::select("update public.calendario_partidos set deleted_at=(now() at time zone 'CST') where
       id=:id
       "
       , ['id'=>$id]
       );
       $msgSuccess="Registro ".$id." eliminado";
       
       }else if($accion==4){
       
       $sql_calendario_partidos = DB::select("update public.calendario_partidos set deleted_at=null where
       id=:id
       "
       , ['id'=>$id]
       );
       $msgSuccess="Registro ".$id." eliminado";
       
       }else{
                       $msgError="Accion invalida";
                   }
       if($msgError==null){
        $calendario_partidos_list = DB::select("select * from (
        select cp.id, cp.id_equipo, e.nombre as equipo, cp.id_equipo_2, e2.nombre as equipo_2,		
               cp.precio, cp.fecha_hora_inicio, cp.fecha_hora_fin
               from public.calendario_partidos cp
               join equipos e on e.id = cp.id_equipo
               join equipos e2 on e2.id = cp.id_equipo_2
               where cp.deleted_at is null
           order by 1 desc 
       ) x where id=:id
       ",[
       "id"=>$id
       ]);
       }
       }catch (Exception $e){
                   $msgError=$e->getMessage();
               }
       return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "calendario_partidos_list"=>$calendario_partidos_list]);
       }
          
}


