<?php

namespace App\Http\Controllers\inicio;

use App\Models\inicio\libro_diario;
use App\Http\Controllers\Controller;
use App\Models\inicio\libro_mayor;
use Illuminate\Http\Request;

class librodiarioController extends Controller
{
    function index(){
        $libros_diarios = libro_diario::all();
        return view('inicio/libro_diario/index',compact('libros_diarios'));
    }

    function insertar_ldiario(){
        return view('inicio/libro_diario/insertar');
    }
    function store( Request $request){

        $request->validate([
            'nombre_denominacion'=>'required',
            'fecha_apertura'=>'required|after:2020-01-01',
            'fecha_cierre'=>'required|after:fecha_apertura'
        ]); 

        $libros_diarios= new libro_diario();
        $libros_diarios->nombre_denominacion=$request->nombre_denominacion;
        $libros_diarios->fecha_apertura=$request->fecha_apertura;
        $libros_diarios->fecha_cierre=$request->fecha_cierre;
        $libros_diarios->id_user=$request->id_user;
        $libros_diarios->save();
        return redirect(route('libro_diario'));
    }

    function editar_ldiario(libro_diario $libros_diarios){
        return view('inicio/libro_diario/editar',compact('libros_diarios'));
    }

    function update(Request $request,libro_diario $libros_diarios){

        $request->validate([
            'nombre_denominacion'=>'required',
            'fecha_apertura'=>'required|after:2020-01-01',
            'fecha_cierre'=>'required|after:fecha_apertura'
        ]);

        $libros_diarios->nombre_denominacion=$request->nombre_denominacion;
        $libros_diarios->fecha_apertura=$request->fecha_apertura;
        $libros_diarios->fecha_cierre=$request->fecha_cierre;
        $libros_diarios->id_user=$request->id_user;
        $libros_diarios->save();
        return redirect(route('libro_diario'));
    }
    function destroy(libro_diario $libros_diarios){

        try {

            $libros_diarios->delete();
            return redirect(route('libro_diario'));
        
        }catch (\Illuminate\Database\QueryException $e){
            return '<script language="javascript"> alert("Lo sentimos este registro no puede ser eliminado ya que forma parte de un asiento contable "); window.location.href="'. route('libro_diario') .'"</script>';
           
        }
        /* $libros_diarios->delete();
        return redirect(route('libro_diario')); */
    }

    
}
