<?php
namespace App\Http\Controllers\plan_cuentas;

use App\Http\Controllers\Controller;
use App\Models\plan_cuentas\cuentas;
use App\Models\plan_cuentas\plan_de_cuentas;
use App\Models\plan_cuentas\subtipo_cuentas;
use App\Models\plan_cuentas\tipo_cuentas;
use Illuminate\Http\Request;

class plandecuentasController extends Controller
{
    function index()
    {
        $plan_de_cuentas=plan_de_cuentas::all();
        return view('plan_de_cuentas/index',compact('plan_de_cuentas'));
    }
    function insertar_cuenta()
    {
        $tipo_cuentas=tipo_cuentas::all();
        $subtipo_cuentas=subtipo_cuentas::all();
        return view('plan_de_cuentas/insertar',compact('tipo_cuentas','subtipo_cuentas'));
    }
    function store(Request $request){

        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'id_tipo_cuenta'=>'required',
            'id_subtipo_cuenta'=>'required'
        ]);

        $cuenta= new cuentas();
        $cuenta->nombre= $request->nombre;
        $cuenta->descripcion=$request->descripcion;
        $cuenta->id_tipo_cuenta =$request->id_tipo_cuenta;
        $cuenta->id_subtipo_cuenta =$request->id_subtipo_cuenta;
        $cuenta->save();
        return redirect(route('plan_de_cuentas'));

    }
    function editar_cuenta( cuentas $cuenta )
    {   
        $tipo_cuentas=tipo_cuentas::all();
        $subtipo_cuentas=subtipo_cuentas::all();
        return view('plan_de_cuentas/editar',compact('cuenta','tipo_cuentas','subtipo_cuentas'));
    }

    function update( Request $request,cuentas $cuenta){
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'id_tipo_cuenta'=>'required',
            'id_subtipo_cuenta'=>'required'
        ]);
        $cuenta->nombre= $request->nombre;
        $cuenta->descripcion=$request->descripcion;
        $cuenta->id_tipo_cuenta =$request->id_tipo_cuenta;
        $cuenta->id_subtipo_cuenta =$request->id_subtipo_cuenta;
        $cuenta->save();
        return redirect(route('plan_de_cuentas'));
    }
    function destroy(cuentas $cuenta){
        $cuenta->delete();
        return redirect(route('plan_de_cuentas'));
    }
}
