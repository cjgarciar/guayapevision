<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {   
       $msgError = null;
       $msgExito = null;
       $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $user_name = $request->name;

        $credentials = request(['name', 'password']);
        $msgError = 'Credenciales Erroneas';

        if (!Auth::attempt($credentials))        
            return response()->json([
                'msgError' => $msgError
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $user_inf = DB::select("select us.id, us.name, tu.nombre tipo_usuario
        from users us 
        join tbl_niveles_usuario nu on us.id = nu.id
        join cat_tipo_usuario tu on nu.id_tipo_usuario = tu.id
        where us.name = :name", [ 'name'=> $user_name]);

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $msgExito = 'Credenciales Correctas, Bienvenido';

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            "mensage"=>"Task end",
            "user_inf"=>$user_inf,
            "msgExito"=> $msgExito
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
