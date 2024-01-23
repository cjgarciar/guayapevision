<?php
//use App\Http\Controllers\PrimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PrimeController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\DslamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);
Route::group(['middleware' => ['auth']], function() {
Route::match(['get', 'post'], 'ajax-file-upload', [PrimeController::class, 'ajaxFile']);

//inicia empleado y permisos de usuario by cgarcia
Route::get("/empleado", [EmpleadoController::class, "ver_per_empleado"]);
Route::get("/empleado/{id_usuario}/perfil-usuario", [EmpleadoController::class, "ver_per_empleado_perfil_usuario"]);
Route::post("/empleado/guardar", [EmpleadoController::class, "guardar_per_empleado"]);
Route::get("/configuraciones/registrar", [EmpleadoController::class, "ver_users"]);
Route::post("/configuraciones/registrar/guardar", [EmpleadoController::class, "guardar_users"]);
Route::post("/configuraciones/permisos/guardar", [EmpleadoController::class, "guardar_seg_usuario_permisos"]);
Route::post("/configuraciones/usuario/reinicio-clave/guardar", [EmpleadoController::class, "guardar_seg_usuario_clave_reinicio"]);
Route::get("/configuraciones/usuario/cambio-calve", [EmpleadoController::class, "ver_users_cambio_clave"]);
Route::post("/configuraciones/usuario/cambio-calve/guardar", [EmpleadoController::class, "guardar_users_cambio_clave"]);
//fin empleado y permisos de usuario

Route::get("/reporte/hola-mundo",[ReportesController::class, "ver_reporte_hola_mundo"]);
Route::get("/reporte/word",[ReportesController::class, "ver_reporte_word"]);

Route::get("/personas", [PersonasController::class, "ver_reg_ficha_personas"]);
Route::post("/personas/guardar", [PersonasController::class, "guardar_reg_ficha_personas"]);

Route::get("/dslams-clientes", [DslamController::class, "ver_tbl_dslams_clientes"]);
Route::post("/dslams-clientes/guardar", [DslamController::class, "guardar_tbl_dslams_clientes"]);

Route::get("/dslams", [DslamController::class, "ver_tbl_dslams"]);
Route::post("/dslams/guardar", [DslamController::class, "guardar_tbl_dslams"]);




});
