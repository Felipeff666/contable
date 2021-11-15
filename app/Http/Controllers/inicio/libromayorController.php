<?php

namespace App\Http\Controllers\inicio;

use App\Models\inicio\libro_mayor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class libromayorController extends Controller
{
    function index(){
        $libros_mayores = libro_mayor::all();
        return view('inicio/libro_mayor/index',compact('libros_mayores'));
    }
    
    function insertar_lmayor(){
        return view('inicio/libro_mayor/insertar');
    }

    function store(Request $request){

        $request->validate([
            'nombre_denominacion'=>'required',
            'gestion'=>'required|after:2020-01-01',
        ]);

        $libros_mayores=new libro_mayor();
        $libros_mayores->nombre_denominacion=$request->nombre_denominacion;
        $libros_mayores->gestion=$request->gestion;
        $libros_mayores->id_user=$request->id_user;
        $libros_mayores->save();
        return redirect(route('libro_mayor'));

    }
    function editar_lmayor(libro_mayor $libros_mayores){
        return view('inicio/libro_mayor/editar',compact('libros_mayores'));
    }
    function update(Request $request ,libro_mayor $libros_mayores ){

        $request->validate([
            'nombre_denominacion'=>'required',
            'gestion'=>'required|after:2020-01-01',
        ]);

        $libros_mayores->nombre_denominacion=$request->nombre_denominacion;
        $libros_mayores->gestion=$request->gestion;
        $libros_mayores->id_user=$request->id_user;
        $libros_mayores->save();
        return redirect(route('libro_mayor'));
    }
    function destroy(libro_mayor $libros_mayores ){
        $libros_mayores->delete();
        return redirect(route('libro_mayor'));
    }
}
