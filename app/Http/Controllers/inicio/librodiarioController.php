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
        $libros_diarios->nombre_denominacion=$request->nombre_denominacion;
        $libros_diarios->fecha_apertura=$request->fecha_apertura;
        $libros_diarios->fecha_cierre=$request->fecha_cierre;
        $libros_diarios->id_user=$request->id_user;
        $libros_diarios->save();
        return redirect(route('libro_diario'));
    }
    function destroy(libro_diario $libros_diarios){
        $libros_diarios->delete();
        return redirect(route('libro_diario'));
    }
}
