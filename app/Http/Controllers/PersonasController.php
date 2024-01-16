<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class PersonasController extends Controller
{
    public function ver_reg_ficha_personas() {
        $sexo_list = DB::select("select 'F' sexo, 'Femenino' nombre  union all
        select 'M' sexo, 'Masculino' as nombre ");
        $pais_nacimiento_list = DB::select("select id, nombre from public.tbl_paises where deleted_at is null");
        $reg_ficha_personas_list = DB::select("
        select rfp.id, rfp.identidad, upper(translate(TRIM(
            COALESCE(TRIM(rfp.primer_nombre)||' ','')||
            COALESCE(TRIM(rfp.segundo_nombre)||' ','')||
            COALESCE(TRIM(rfp.primer_apellido)||' ','')||
            COALESCE(TRIM(rfp.segundo_apellido||' '),'')
        ),'áéíóúñÁÉÍÓÚäëïöüÄËÏÖÜÑ','aeiounAEIOUaeiouAEIOUN') ) as nombre_persona        
        , rfp.primer_nombre, rfp.segundo_nombre, rfp.primer_apellido, rfp.segundo_apellido, rfp.fecha_nacimiento,
        rfp.sexo, rfp.telefono, rfp.id_pais_nacimiento, tp.nombre as pais_nacimiento,
         rfp.id_departamento_nacimiento, rfp.id_municipio_nacimiento, rfp.id_pais_residencia, rfp.id_departamento_residencia,
        rfp.id_municipio_residencia, rfp.domicilio
        from public.reg_ficha_personas rfp
        left join public.tbl_departamentos td on td.id = rfp.id_departamento_residencia
        left join public.tbl_municipios tm on tm.id = rfp.id_municipio_residencia
        left join public.tbl_paises tp on tp.id = rfp.id_pais_nacimiento 
        left join public.tbl_departamentos td1 on td1.id = rfp.id_departamento_nacimiento
        left join public.tbl_municipios tm1 on tm1.id = rfp.id_municipio_nacimiento 
        left join public.tbl_paises tp1 on tp1.id = rfp.id_pais_residencia        
        where rfp.deleted_at is null
        order by 1 desc
       "
       );
       return view("personas.personas")->with("reg_ficha_personas_list", $reg_ficha_personas_list)
       ->with("sexo_list", $sexo_list)
       ->with("pais_nacimiento_list", $pais_nacimiento_list)
       ;
       }
       
       public function guardar_reg_ficha_personas(Request $request) {
       $id=$request->id;
       $identidad=$request->identidad;
       $primer_nombre=$request->primer_nombre;
       $segundo_nombre=$request->segundo_nombre;
       $primer_apellido=$request->primer_apellido;
       $segundo_apellido=$request->segundo_apellido;
       $fecha_nacimiento=$request->fecha_nacimiento;
       $sexo=$request->sexo;
       $telefono=$request->telefono;
       $id_pais_nacimiento=$request->id_pais_nacimiento;
       $domicilio=$request->domicilio;
       $msgError=null;
       $msgSuccess=null;
       $accion=$request->accion;
       $reg_ficha_personas_list=null;
       if($id==null && $accion==2){
                   $accion=1;
               }
       try{ 
       
       if($accion==1){
       $sql_reg_ficha_personas = DB::select("insert INTO public.reg_ficha_personas (
       domicilio,fecha_nacimiento,id_pais_nacimiento,identidad,primer_apellido,primer_nombre,segundo_apellido,segundo_nombre,sexo,telefono
       , created_at) values (
       :domicilio,:fecha_nacimiento,:id_pais_nacimiento,:identidad,:primer_apellido,:primer_nombre,:segundo_apellido,:segundo_nombre,:sexo,:telefono
       , now() )
       RETURNING  id
       ", ['domicilio'=>$domicilio,'fecha_nacimiento'=>$fecha_nacimiento,
       'id_pais_nacimiento'=>$id_pais_nacimiento,'identidad'=>$identidad,
       'primer_apellido'=>$primer_apellido,'primer_nombre'=>$primer_nombre,
       'segundo_apellido'=>$segundo_apellido,'segundo_nombre'=>$segundo_nombre,
       'sexo'=>$sexo,'telefono'=>$telefono
       ]
       );
       foreach($sql_reg_ficha_personas as $r){
       $id=$r->id;
       }
       $msgSuccess="Registro creado con el código: ".$id;
       }else if($accion==2){
       $sql_reg_ficha_personas = DB::select("update public.reg_ficha_personas set  updated_at = now(),
       domicilio=:domicilio,fecha_nacimiento=:fecha_nacimiento,id_pais_nacimiento=:id_pais_nacimiento,identidad=:identidad,
       primer_apellido=:primer_apellido,primer_nombre=:primer_nombre,segundo_apellido=:segundo_apellido,segundo_nombre=:segundo_nombre,
       sexo=:sexo,telefono=:telefono
       where id=:id
       "
       , ['domicilio'=>$domicilio,'fecha_nacimiento'=>$fecha_nacimiento,'id'=>$id,
       'id_pais_nacimiento'=>$id_pais_nacimiento,'identidad'=>$identidad,
       'primer_apellido'=>$primer_apellido,'primer_nombre'=>$primer_nombre,
       'segundo_apellido'=>$segundo_apellido,'segundo_nombre'=>$segundo_nombre,
       'sexo'=>$sexo,'telefono'=>$telefono
       ]
       );
       $msgSuccess="Registro ".$id." actualizado";
       
       }else if($accion==3){
       
       $sql_reg_ficha_personas = DB::select("update public.reg_ficha_personas set deleted_at=now() where
       id=:id
       "
       , ['id'=>$id]
       );
       $msgSuccess="Registro ".$id." eliminado";
       
       }else if($accion==4){
       
       $sql_reg_ficha_personas = DB::select("update public.reg_ficha_personas set deleted_at=null where
       id=:id
       "
       , ['id'=>$id]
       );
       $msgSuccess="Registro ".$id." eliminado";
       
       }else{
                       $msgError="Accion invalida";
                   }
       if($msgError==null){
        $reg_ficha_personas_list = DB::select("select * from (
            select rfp.id, rfp.identidad, upper(translate(TRIM(
                COALESCE(TRIM(rfp.primer_nombre)||' ','')||
                COALESCE(TRIM(rfp.segundo_nombre)||' ','')||
                COALESCE(TRIM(rfp.primer_apellido)||' ','')||
                COALESCE(TRIM(rfp.segundo_apellido||' '),'')
            ),'áéíóúñÁÉÍÓÚäëïöüÄËÏÖÜÑ','aeiounAEIOUaeiouAEIOUN') ) as nombre_persona        
            , rfp.primer_nombre, rfp.segundo_nombre, rfp.primer_apellido, rfp.segundo_apellido, rfp.fecha_nacimiento,
             rfp.sexo, rfp.telefono, rfp.id_pais_nacimiento, tp.nombre as pais_nacimiento,
             rfp.id_departamento_nacimiento, rfp.id_municipio_nacimiento, rfp.id_pais_residencia, rfp.id_departamento_residencia,
            rfp.id_municipio_residencia, rfp.domicilio
            from public.reg_ficha_personas rfp
            left join public.tbl_departamentos td on td.id = rfp.id_departamento_residencia
            left join public.tbl_municipios tm on tm.id = rfp.id_municipio_residencia
            left join public.tbl_paises tp on tp.id = rfp.id_pais_nacimiento 
            left join public.tbl_departamentos td1 on td1.id = rfp.id_departamento_nacimiento
            left join public.tbl_municipios tm1 on tm1.id = rfp.id_municipio_nacimiento 
            left join public.tbl_paises tp1 on tp1.id = rfp.id_pais_residencia            
            where rfp.deleted_at is null
            order by 1 desc
       ) x where id=:id
       ",[
       "id"=>$id
       ]);
       }
       }catch (Exception $e){
                   $msgError=$e->getMessage();
               }

       return response()->json(["msgSuccess" => $msgSuccess,"msgError"=>$msgError, "reg_ficha_personas_list"=>$reg_ficha_personas_list]);
    }      
       
}
