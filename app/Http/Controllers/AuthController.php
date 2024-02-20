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

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'telefono' => 'required|string'
        ]);

        $name = $request['name'];
        $username = $request['username'];
        $email = $request['email'];
        $password = $request['password'];
        $telefono = $request['telefono'];

        $verificar_cuenta = collect(\DB::select("WITH cuenta as (
                select :username username, :email email
            )
            select c.username, c.email,
            case 
                when u.username = c.username or u.email = c.email then false
                else true end registrar,
            case 
                when u.username = c.username then 'El nombre de usuario ya existe.'
                when u.email = c.email then 'El correo ingresado ya existe.'
                else null end mensaje
            from users u
            right join cuenta c on u.username = c.username or u.email = c.email",
            ["username" => $username, "email" => $email]))->first();

        if(!$verificar_cuenta->registrar){
            return response()->json([
                'message' => $verificar_cuenta->mensaje
            ], 401);
        }

        User::create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'telefono' => $telefono,
            'forzar_cambio_contrasenia' => 'true'
        ]);

        return response()->json([
           'message' => 'Authorized'
        ]);
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {   
       $msgError = null;
       $msgExito = null;
       $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $username = $request['email'];
        $password = $request['password'];
        $fieldType = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [$fieldType => $username, "password" => $password];
        $msgError = 'Credenciales Erroneas';

        if (!Auth::attempt($credentials))        
            return response()->json([
                  'message' => 'Unauthorized',
                'name'=>'',                
                'token' => '',
                'id_rol'=>0,
                'username'=>''              
                                
                //'access_token'=>''
                
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        // $user_inf = DB::select("select us.id, us.name, tu.nombre tipo_usuario
        // from users us 
        // join tbl_niveles_usuario nu on us.id = nu.id
        // join cat_tipo_usuario tu on nu.id_tipo_usuario = tu.id
        // where us.username = :username", [ 'username'=> $user_name]);

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $msgExito = 'Credenciales Correctas, Bienvenido';

        return response()->json([
             'message' => 'Authorized',
            'name'=>Auth::user()->name,
            //'email'=>Auth::user()->email,
            'username'=>Auth::user()->username,
            'id_rol'=>Auth::user()->id_rol,
            'token' => 'Bearer '.$tokenResult->accessToken,
            //'access_token' => $tokenResult->accessToken
            //'token_type' => 'Bearer',
            //'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
