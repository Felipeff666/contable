<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\resultados\balanza_de_comprobacion;
use Illuminate\Http\Request;

class balanza_de_comprobacionController extends Controller
{
    function index()
    {   
        $balanza_de_comprobacion= balanza_de_comprobacion::all();
        return view('resultados/balanza_de_comprobacion/index',compact('balanza_de_comprobacion'));
    }
}
