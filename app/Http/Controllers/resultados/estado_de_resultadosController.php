<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\resultados\estado_de_resultados;
use Illuminate\Http\Request;

class estado_de_resultadosController extends Controller
{   
    function index(){

        $estado_de_resultados=estado_de_resultados::all();
        return view('resultados/estado_de_resultados/index',compact('estado_de_resultados'));
    }
    
}
