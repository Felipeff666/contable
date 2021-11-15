<?php

namespace App\Http\Controllers\inicio;
use App\Http\Controllers\Controller;
use App\Models\inicio\asiento_contable;
use Illuminate\Http\Request;



class asientocontableController extends Controller
{   
    function index()
    {    
        $asiento_contable = asiento_contable::all();
        return view('inicio/asiento_contable/index',compact('asiento_contable'));
    }
    function insertar_asiento(){
        return view("inicio/asiento_contable/insertar");
    }
    function store(){
    }
    function editar_asiento(){
        return view("inicio/asiento_contable/editar");
    }
    function borrar_asiento(){

    }
    
}
