<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class resultadosController extends Controller
{
    function index()
    {
        return view('resultados/resultados');
    }
}
