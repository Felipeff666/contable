<?php

namespace App\Http\Controllers\inicio;
use App\Http\Controllers\Controller;
use App\Models\inicio\asiento_contable;
use App\Models\inicio\libro_diario;
use App\Models\inicio\libro_mayor;
use App\Models\plan_cuentas\cuentas;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;



class asientocontableController extends Controller
{   
    function index()
    {    
        $asiento_contable = asiento_contable::paginate(4);
        $libros_mayores = libro_mayor::all();
        $libros_diarios = libro_diario::all();
        $cuentas = cuentas::all();
        $users = User::all();
        return view('inicio/asiento_contable/index',compact('asiento_contable','libros_mayores','libros_diarios','cuentas','users'));
    }
    function insertar_asiento(){
        $libros_mayores = libro_mayor::all();
        $libros_diarios = libro_diario::all();
        $cuentas = cuentas::all();
        return view("inicio/asiento_contable/insertar",compact('libros_mayores','libros_diarios','cuentas'));
    }
    function store(Request $request ){

        $request->validate([
            'numero_asiento'=>'required',
            'fecha'=>'required|after:2020-01-01',
            'banderas'=>'required',
            'deber'=>'required',
            'haber'=>'required',
            'id_cuenta'=>'required',
            'id_diario'=>'required',
            'id_mayor'=>'required',
            'glosa'=>'required',
            
        ]);

        $asiento_contable = new asiento_contable();
        $asiento_contable->numero_asiento=$request->numero_asiento;
        $asiento_contable->fecha=$request->fecha;
        $asiento_contable->banderas=$request->banderas;
        $asiento_contable->deber=$request->deber;
        $asiento_contable->haber=$request->haber;
        $asiento_contable->id_cuenta=$request->id_cuenta;
        $asiento_contable->id_diario=$request->id_diario;
        $asiento_contable->id_mayor=$request->id_mayor;
        $asiento_contable->glosa=$request->glosa;
        $asiento_contable->id_user=$request->id_user;
        /* return $asiento_contable; */
        $asiento_contable->save();
        return redirect(route('asiento_contable'));
        
    }
    function editar_asiento(asiento_contable $asiento_contable){
        
        $libros_mayores = libro_mayor::all();
        $libros_diarios = libro_diario::all();
        $cuentas = cuentas::all();
        return view("inicio/asiento_contable/editar",compact('asiento_contable','libros_mayores','libros_diarios','cuentas'));
    }
    function update(Request $request,asiento_contable $asiento_contable){

        $request->validate([
            'numero_asiento'=>'required',
            'fecha'=>'required|after:2020-01-01',
            'banderas'=>'required',
            'deber'=>'required',
            'haber'=>'required',
            'id_cuenta'=>'required',
            'id_diario'=>'required',
            'id_mayor'=>'required',
            'glosa'=>'required',
            
        ]);

        $asiento_contable->numero_asiento=$request->numero_asiento;
        $asiento_contable->fecha=$request->fecha;
        $asiento_contable->banderas=$request->banderas;
        $asiento_contable->deber=$request->deber;
        $asiento_contable->haber=$request->haber;
        $asiento_contable->id_cuenta=$request->id_cuenta;
        $asiento_contable->id_diario=$request->id_diario;
        $asiento_contable->id_mayor=$request->id_mayor;
        $asiento_contable->glosa=$request->glosa;
        $asiento_contable->id_user=$request->id_user;
        /* return $asiento_contable; */
        $asiento_contable->save();
        return redirect(route('asiento_contable'));
    }
    function destroy(asiento_contable $asiento_contable){

       /*  return $asiento_contable; */
        $asiento_contable->delete();
        return redirect(route('asiento_contable'));

    }
    function pdf(){
        $asiento_contable = asiento_contable::all();
        $libros_mayores = libro_mayor::all();
        $libros_diarios = libro_diario::all();
        $cuentas = cuentas::all();
        $users = User::all();
        $pdf = PDF::loadView('inicio/asiento_contable/pdf',['asiento_contable'=>$asiento_contable,'libros_mayores'=>$libros_mayores,'libros_diarios'=>$libros_diarios,'cuentas'=>$cuentas,'users'=>$users]);
        return $pdf->stream('asientos contables.pdf');
        /* return view('inicio/asiento_contable/index',compact('asiento_contable','libros_mayores','libros_diarios','cuentas','users')); */
    }
    
}
