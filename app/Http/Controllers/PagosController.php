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
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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
            'mensaje' => 'Pagos cargados con exito!',
            'estatus'=>true,
            'pagos' => $pagos
        ]);
    }

    public function bloqueo_partido(){

        $id_user = Auth::user()->id;
        
        $id_calendario_partido = COLLECT(DB::SELECT("
            SELECT ID FROM CALENDARIO_PARTIDOS
            WHERE (now() at time zone 'CST')::date=FECHA_HORA_INICIO::date
            AND DELETED_AT IS NULL
        "))->first();

        $id_calendario_partido = isset($id_calendario_partido->id)?$id_calendario_partido->id:null;

        if ($id_calendario_partido) {
            $pago = DB::SELECT("
                SELECT ID_USER FROM PAGOS_PARTIDOS 
                WHERE ID_CALENDARIO_PARTIDO = :id_calendario_partido
                and id_user = :id_user
                and deleted_at is null
            ", ['id_calendario_partido' =>$id_calendario_partido, 'id_user' =>$id_user]);


            //$bloqueo = empty($pago);

            if ($pago) {
                $bloqueo = false;
            }else{
                $bloqueo = true;
            }

        }else{
            $bloqueo = false;
        }

        return response()->json([
            'mensaje' => 'ok',
            'bloquear'=> $bloqueo,
            'estatus'=>true
            
        ]);

    }

    public function guardar_pagos(Request $request){
        $id = $request->id;
        $id_user = Auth::user()->id;
        //$id_user = isset(Auth::user()->id) ? Auth::user()->id : 1;
        $id_calendario_partido = $request->id_calendario_partido;
        $accion = $request->accion;
        //$username = $request->username;
        $msgError = null;
        $msgSuccess = null;
        $statusCode = null;

        if ($id == null && $accion == 2) {
            $accion = 1;
        }

        try {

            if ($accion == 1) {
               
               $insert_pagos_partidos = DB::SELECT("
                INSERT INTO pagos_partidos(id_user, id_calendario_partido, created_at) 
                values (:id_user, :id_calendario_partido::int, (now() at time zone 'CST')) 
                RETURNING id
                ", ["id_user"=>$id_user, "id_calendario_partido"=>$id_calendario_partido]);

                foreach ($insert_pagos_partidos as $r) {
                    $id = $r->id;
                }

                $msgSuccess = "Pago Realizado Con Exito!";
                $statusCode = 201;
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
                    "update pagos_partidos set deleted_at=now() where id=:id 
                    ",
                    ['id' => $id]
                );

                $msgSuccess = "Pago Eliminado con Exito!";

            } else {
                $msgError = "Accion invalida";
                $statusCode = 101;
            }

            

        } catch (Exception $e) {
            $msgError = "Error al guardar: ".$e->getMessage();
        }

        return response()->json([
            /*'mensaje' => $msgSuccess,
            'error' => $msgError,
            'estatus'=>true,*/
            'statusCode'=>$statusCode,
            'id' => 0,
            'precio' => '0',
            'encuentro' => '',
            'fecha_hora_inicio' => '',
            'pago_partido' => false,
            'clientid' => '',
            'secretkey' => ''
        ]);
    }

    public function ver_enlaces_streaming(){
        
        $sql_enlace_tv = COLLECT(DB::SELECT("select enlace_tv_vivo from public.tbl_enlaces_streaming
        where deleted_at is null
        "))->first();
        
        $enlace_tv = isset($sql_enlace_tv->enlace_tv_vivo)?$sql_enlace_tv->enlace_tv_vivo:null;
        
        $sql_enlace_radio = COLLECT(DB::SELECT("select enlace_radio_vivo from public.tbl_enlaces_streaming
        where deleted_at is null
        "))->first();
        
        $enlace_radio = isset($sql_enlace_radio->enlace_radio_vivo)?$sql_enlace_radio->enlace_radio_vivo:null;

        return response()->json([
            'mensaje' => 'Authorized',
            'estatus'=>true,
            'enlaceTv' => $enlace_tv,
            'enlaceRadio' => $enlace_radio            
        ]);
    }
    
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction(){

        $id_user = Auth::user()->id;

        $calendario_partidos_list = DB::select("
            select cp.id, cp.id_equipo, upper(e.nombre) as equipo, cp.id_equipo_2, upper(e2.nombre) as equipo_2,
            upper(e.nombre)||' vs '||upper(e2.nombre) encuentro,
            cp.precio, to_char(cp.fecha_hora_inicio, 'DD/MM/YYYY HH:MI AM') fecha_hora_inicio,
            to_char(cp.fecha_hora_fin, 'DD/MM/YYYY HH:MI AM') fecha_hora_fin, pp.id_user,
            case when pp.id_calendario_partido is not null then true else false end as pago_partido            
            from public.calendario_partidos cp
            join equipos e on e.id = cp.id_equipo
            join equipos e2 on e2.id = cp.id_equipo_2
            left join public.pagos_partidos pp on pp.id_calendario_partido = cp.id and pp.id_user = :id_user and pp.deleted_at is null
            join public.tbl_cuenta_paypal tcp on true
            where cp.deleted_at is null
            and cp.fecha_hora_inicio::date = (now() at time zone 'CST')::date  
	        order by 1 desc 
        ",[
            'id_user' => $id_user
        ]);

        return view('paypal.ticketPartido')
        ->with("calendario_partidos_list", $calendario_partidos_list);
}
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request){

        $idPartido = $request->idPartido;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "brand_name" => "GUAYAPE VISION",
                "return_url" => route('successTransaction', ['idPartido' => $idPartido]),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "description" => "Apple",
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "5.00",                        
                    ],
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createTransaction')
                ->with('error', 'Algo salio mal.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Algo salio mal.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request){

        $idPartido = $request->idPartido;
        $id_user = Auth::user()->id;
        $sql_pagos_partidos = null;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $sql_pagos_partidos = DB::select("insert into public.pagos_partidos( id_user, id_calendario_partido, created_at)
            values( :id_user, :id_calendario_partido, (now() at time zone 'CST') )",[
                'id_user' => $id_user,
                'id_calendario_partido' => $idPartido
            ]);

            return redirect()
                ->route('createTransaction')
                ->with('success', 'Transaction completa, compra realizada.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Algo salio mal.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'Transacción Cancelada.');
    }

    public function radio_streaming(){

        return view('paypal.radio');
    }
    
}
