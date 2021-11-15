<?php

namespace App\Http\Controllers\plan_cuentas;
use App\Http\Controllers\Controller;
use App\Models\plan_cuentas\tipo_cuentas;

use Illuminate\Http\Request;

class tipocuentasController extends Controller
{
    function index(){
        $tipo_cuenta=tipo_cuentas::all();
        return view('plan_de_cuentas/tipo_cuentas/index',compact('tipo_cuenta'));
    }
    function insertar_tipocuenta()
    {
        return view('plan_de_cuentas/tipo_cuentas/insertar');
    }
    function store(Request $request){

        /* $tipo_cuenta = $request->all();
        tipo_cuentas::create([
            'nombre'=>$tipo_cuenta['nombre'],
        ]);
        return redirect(route('tipo_cuentas/insertar')); */

        $tipo_cuenta = new tipo_cuentas();
        $tipo_cuenta->nombre= $request->nombre;  
        $tipo_cuenta->save();
        return redirect(route('tipo_cuentas')); 
    }
    function editar_tipocuenta(tipo_cuentas $tipo_cuenta )
    {   
        return view('plan_de_cuentas/tipo_cuentas/editar',compact('tipo_cuenta'));
    }
    function update(Request $request, tipo_cuentas $tipo_cuenta){
        $tipo_cuenta->nombre=$request->nombre;
        $tipo_cuenta->save();
        return redirect(route('tipo_cuentas')); 
    }
    function destroy(tipo_cuentas $tipo_cuenta){
        $tipo_cuenta->delete();
        return redirect(route('tipo_cuentas'));
    }
}
