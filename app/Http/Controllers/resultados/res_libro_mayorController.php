<?php

namespace App\Http\Controllers\resultados;

use App\Http\Controllers\Controller;
use App\Models\inicio\libro_mayor;
use App\Models\resultados\res_libro_mayor;
use PDF;
use Illuminate\Http\Request;

class res_libro_mayorController extends Controller
{
    function index(){
        $res_l_mayor = res_libro_mayor::all();
        return view('resultados/libro_mayor/index',compact('res_l_mayor'));
    }

    function pdf(){
        $libro_mayor = libro_mayor::all();
        $res_l_mayor = res_libro_mayor::all();
        $pdf = PDF::loadView('resultados/pdf/l_mayor',['res_l_mayor'=>$res_l_mayor,'libro_mayor'=>$libro_mayor]);
        return $pdf->stream('libro_mayor_'.date('d').'-'.date('m').'-'.date('y').'.pdf');
    }
}
