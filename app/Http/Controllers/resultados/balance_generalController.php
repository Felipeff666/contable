<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\resultados\balance_general;
use Illuminate\Http\Request;

class balance_generalController extends Controller
{
    function index(){

        $balance_general=balance_general::all();
        return view('resultados/balance_general/index',compact('balance_general'));

    }
}
