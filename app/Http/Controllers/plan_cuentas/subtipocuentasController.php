<?php
namespace App\Http\Controllers\plan_cuentas;
use App\Http\Controllers\Controller;
use App\Models\plan_cuentas\subtipo_cuentas;
use Illuminate\Http\Request;


class subtipocuentasController extends Controller
{
    function index(){
        $subtipo_cuenta=subtipo_cuentas::all();
        return view('plan_de_cuentas/subtipo_cuentas/index',compact('subtipo_cuenta'));
    }
    function insertar_subtipocuenta(){
        
        return view('plan_de_cuentas/subtipo_cuentas/insertar');
    }
    function store(Request $request){

        $request->validate([
            'nombre'=>'required'
            ]);

        $subtipo_cuenta=new subtipo_cuentas();
        $subtipo_cuenta->nombre=$request->nombre;
        $subtipo_cuenta->save();
        return redirect(route('subtipo_cuentas'));
    }
    function editar_subtipocuenta(subtipo_cuentas $subtipo_cuenta){
        return view('plan_de_cuentas/subtipo_cuentas/editar',compact('subtipo_cuenta'));
    }
    function update(Request $request,subtipo_cuentas $subtipo_cuenta){

        $request->validate([
            'nombre'=>'required'
            ]);

        $subtipo_cuenta->nombre=$request->nombre;
        $subtipo_cuenta->save();
        return redirect(route('subtipo_cuentas'));
    }
    function destroy(subtipo_cuentas $subtipo_cuenta){

        try {

            $subtipo_cuenta->delete();
            return redirect(route('subtipo_cuentas'));
        
        }catch (\Illuminate\Database\QueryException $e){
            
            return '<script language="javascript"> alert("Lo sentimos este registro no puede ser eliminado por que forma parte un registro en el plan de cuentas  "); window.location.href="'. route('subtipo_cuentas') .'"</script>';
           
        }
        /* $subtipo_cuenta->delete();
        return redirect(route('subtipo_cuentas')); */
    }
}
