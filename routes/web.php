<?php

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\inicio\asientocontableController;
use App\Http\Controllers\inicio\inicioController;
use App\Http\Controllers\inicio\librodiarioController;
use App\Http\Controllers\inicio\libromayorController;
use App\Http\Controllers\plan_cuentas\plandecuentasController;
use App\Http\Controllers\plan_cuentas\subtipocuentasController;
use App\Http\Controllers\plan_cuentas\tipocuentasController;
use App\Http\Controllers\resultados\balance_generalController;
use App\Http\Controllers\resultados\balanza_de_comprobacionController;
use App\Http\Controllers\resultados\estado_de_capitalController;
use App\Http\Controllers\resultados\estado_de_resultadosController;
use App\Http\Controllers\resultados\resultadosController;
use App\Http\Controllers\usuarios\usuariosController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', inicioController::class
)->name('dashboard'); */


/* inicio */
Route::middleware(['auth:sanctum', 'verified'])->get('inicio', inicioController::class
)->name('inicio');





/* asiento contable -------------------------------------------------------------------------------------------------------------------------------------------------*/

Route::middleware(['auth:sanctum', 'verified'])->get('asiento_contable', [asientocontableController::class,'index']
)->name('asiento_contable');

Route::middleware(['auth:sanctum', 'verified'])->get('asiento_contable/insertar', [asientocontableController::class,'insertar_asiento']
)->name('asiento_contable/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('asiento_contable/insertar/reg', [asientocontableController::class,'store']
)->name('asiento_contable/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('asiento_contable/editar/{asiento_contable}', [asientocontableController::class,'editar_asiento']
)->name('asiento_contable/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('asiento_contable/editar/{asiento_contable}/edit', [asientocontableController::class,'update']
)->name('asiento_contable/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('asiento_contable/{asiento_contable}/del', [asientocontableController::class,'destroy']
)->name('asiento_contable/del');






/* libro diario ----------------------------------------------------------------------------------------------------------------------------------------------------*/

Route::middleware(['auth:sanctum', 'verified'])->get('libro_diario', [librodiarioController::class,'index']
)->name('libro_diario');

Route::middleware(['auth:sanctum', 'verified'])->get('libro_diario/insertar', [librodiarioController::class,'insertar_ldiario']
)->name('libro_diario/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('libro_diario/insertar/reg', [librodiarioController::class,'store']
)->name('libro_diario/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('libro_diario/editar/{libros_diarios}', [librodiarioController::class,'editar_ldiario']
)->name('libro_diario/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('libro_diario/editar/{libros_diarios}/edit', [librodiarioController::class,'update']
)->name('libro_diario/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('libro_diario/{libros_diarios}/del', [librodiarioController::class,'destroy']
)->name('libro_diario/del');





/* libro mayor ------------------------------------------------------------------------------------------------------------------------------------------------------*/
Route::middleware(['auth:sanctum', 'verified'])->get('libro_mayor', [libromayorController::class,'index']
)->name('libro_mayor');

Route::middleware(['auth:sanctum', 'verified'])->get('libro_mayor/insertar', [libromayorController::class,'insertar_lmayor']
)->name('libro_mayor/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('libro_mayor/insertar/reg', [libromayorController::class,'store']
)->name('libro_mayor/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('libro_mayor/editar/{libros_mayores}', [libromayorController::class,'editar_lmayor']
)->name('libro_mayor/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('libro_mayor/editar/{libros_mayores}/edit', [libromayorController::class,'update']
)->name('libro_mayor/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('libro_mayor/{libros_mayores}/del', [libromayorController::class,'destroy']
)->name('libro_mayor/del');




/* plan de cuentas--------------------------------------------------------------------------------------------------------------------------------------------------- */

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas', [plandecuentasController::class,'index']
)->name('plan_de_cuentas');

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/insertar',[plandecuentasController::class,'insertar_cuenta']
)->name('plan_de_cuentas/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('plan_de_cuentas/insertar/reg',[plandecuentasController::class,'store']
)->name('plan_de_cuentas/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/insertar/editar/{cuenta}',[plandecuentasController::class,'editar_cuenta']
)->name('plan_de_cuentas/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('plan_de_cuentas/insertar/editar/{cuenta}/edit',[plandecuentasController::class,'update']
)->name('plan_de_cuentas/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('plan_de_cuentas/{cuenta}/del',[plandecuentasController::class,'destroy']
)->name('plan_de_cuentas/del');


/* plan de cuentas TIPO---------------------------------------------------------------------------------------------------------------------------------------------*/


Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/tipo_cuentas', [tipocuentasController::class,'index']
)->name('tipo_cuentas');

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/tipo_cuentas/insertar', [tipocuentasController::class,'insertar_tipocuenta']
)->name('tipo_cuentas/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('plan_de_cuentas/tipo_cuentas/insertar/reg', [tipocuentasController::class,'store']
)->name('tipo_cuentas/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/tipo_cuentas/editar/{tipo_cuenta}', [tipocuentasController::class,'editar_tipocuenta']
)->name('tipo_cuentas/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('plan_de_cuentas/tipo_cuentas/editar/{tipo_cuenta}/edit', [tipocuentasController::class,'update']
)->name('tipo_cuentas/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('plan_de_cuentas/tipo_cuentas/{tipo_cuenta}/del', [tipocuentasController::class,'destroy']
)->name('tipo_cuentas/del');





/* plan de cuentas SUBTIPO-----------------------------------------------------------------------------------------------------------------------------------------*/

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/subtipo_cuentas', [subtipocuentasController::class,'index']
)->name('subtipo_cuentas');

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/subtipo_cuentas/insertar', [subtipocuentasController::class,'insertar_subtipocuenta']
)->name('subtipo_cuentas/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('plan_de_cuentas/subtipo_cuentas/insertar/reg', [subtipocuentasController::class,'store']
)->name('subtipo_cuentas/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('plan_de_cuentas/subtipo_cuentas/editar/{subtipo_cuenta}', [subtipocuentasController::class,'editar_subtipocuenta']
)->name('subtipo_cuentas/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('plan_de_cuentas/subtipo_cuentas/editar/{subtipo_cuenta}/edit', [subtipocuentasController::class,'update']
)->name('subtipo_cuentas/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('plan_de_cuentas/subtipo_cuentas/{subtipo_cuenta}/del', [subtipocuentasController::class,'destroy']
)->name('subtipo_cuentas/del');





/* resultados------------------------------------------------------------------------ */

Route::middleware(['auth:sanctum', 'verified'])->get('resultados', [ resultadosController::class,'index']
)->name('resultados');

/* Balanza de comprobacion------------------------------------------------------------------------ */

Route::middleware(['auth:sanctum', 'verified'])->get('resultados/balanza_de_comprobacion', [ balanza_de_comprobacionController::class,'index']
)->name('balanza_de_comprobacion');

/* estado de resultados------------------------------------------------------------------------ */

Route::middleware(['auth:sanctum', 'verified'])->get('resultados/estado_de_resultados', [ estado_de_resultadosController::class,'index']
)->name('estado_de_resultados');

/* estado del capital contable------------------------------------------------------------------------ */

Route::middleware(['auth:sanctum', 'verified'])->get('resultados/estado_de_capital', [ estado_de_capitalController::class,'index']
)->name('estado_de_capital');

/* Balance general------------------------------------------------------------------------ */

Route::middleware(['auth:sanctum', 'verified'])->get('resultados/balance_general', [ balance_generalController::class,'index']
)->name('balance_general');






/* usuarios----------------------------------------------------------------------------------------*/

Route::middleware(['auth:sanctum', 'verified'])->get('usuarios', [ usuariosController::class,'index']
)->name('usuarios');

Route::middleware(['auth:sanctum', 'verified'])->get('usuarios/insertar', [ usuariosController::class,'insertar_usuario']
)->name('usuarios/insertar');

Route::middleware(['auth:sanctum', 'verified'])->post('usuarios/insertar/reg', [ usuariosController::class,'store']
)->name('usuarios/insertar/reg');

Route::middleware(['auth:sanctum', 'verified'])->get('usuarios/editar/{usuarios}', [ usuariosController::class,'editar_usuario']
)->name('usuarios/editar');

Route::middleware(['auth:sanctum', 'verified'])->put('usuarios/editar/{usuarios}/edit', [ usuariosController::class,'update']
)->name('usuarios/editar/edit');

Route::middleware(['auth:sanctum', 'verified'])->delete('usuarios/{usuarios}/del', [ usuariosController::class,'destroy']
)->name('usuarios/del');

