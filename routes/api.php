<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\CentrosCostosSap\CentroCostosController;
use App\Http\Controllers\Compras\ComprasController;
use App\Http\Controllers\Cotizaciones_Formaletas\CotizacionesController;
use App\Http\Controllers\DepartamentoTI\InventarioController;
use App\Http\Controllers\DepartamentoTI\Licencias\LicenciasController;
use App\Http\Controllers\EstructuraMetalicaController;
use App\Http\Controllers\GestionHumana\CargosController;
use App\Http\Controllers\GestionHumana\RequisicionPersonalController;
use App\Http\Controllers\GestionHumana\TiposContratosController;
use App\Http\Controllers\IntegracionSAP\AnalisisVentaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntegracionSAP\AnalisisVentaVorteController;
use App\Http\Controllers\ModuloFinanzas\ModuloFacture\PedidoCompraController;
use App\Http\Controllers\ModuloFinanzas\ModuloCartera\SolicitudesCreditoController;
use App\Http\Controllers\ModuloFinanzas\ModuloCartera\CuentasporpagarController;
use App\Http\Controllers\Logistica\AbastecimientoMRPSAP\AbastecimientoController;
use App\Http\Controllers\Logistica\AbastecimientoMRPSAP\Abastecimiento_MRP_ALMACENController;
use App\Http\Controllers\Logistica\CostoProductosController;
use App\Http\Controllers\ProyectosSAP\ProyectosSAPController;
use App\Http\Controllers\Seguridad\EtapasAutorizacion\AprobadorPasosController;
use App\Http\Controllers\Seguridad\EtapasAutorizacion\EtapasController;
use App\Http\Controllers\VorteController;
use App\Models\GestionHumana\RequisicionPersonal;
use App\Models\GestionHumana\TiposContrato;
use App\Models\Logistica\Abastesimiento;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


// Proteger todas las rutas con autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {

  
    //Rutas de seguridad 
    Route::get('/usuarios', [AuthController::class, 'listusers']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::put('/usuarios/actualizar/{id}', [AuthController::class, 'actualizarUsuario']);
    Route::put('/usuarios/inactivar/{id}',[AuthController::class, 'inactivarusuario']);
    Route::post('/reset-password/{id}', [AuthController::class, 'resetPassword']);


    //roles
    Route::get('/roles', [RolesController::class, 'index']);
    Route::put('/roles/update/{id}', [RolesController::class, 'update']);
    Route::post('v1/roles/store', [RolesController::class, 'store']);
    // Route::delete('v1/usuarios/destroy/{id}', [AuthController::class, 'eliminarUsuario']);
  
  
    //permisos  
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::post('/permissions', [PermissionController::class, 'store']);
    Route::put('V1/permissions/update/{id}', [PermissionController::class, 'update']);
    Route::delete('V1/permissions/destroy/{permission}', [PermissionController::class, 'destroy']);


});
