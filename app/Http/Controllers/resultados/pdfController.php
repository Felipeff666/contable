<?php

namespace App\Http\Controllers\resultados;
use App\Models\resultados\estado_de_capital;
use App\Models\resultados\estado_de_resultados;
use App\Models\resultados\balance_general;
use App\Models\resultados\balanza_de_comprobacion;
use App\Http\Controllers\Controller;
use App\Models\inicio\libro_diario;
use App\Models\inicio\libro_mayor;
use PDF;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    function pdf(){

        $libros_diarios = libro_diario::all();
        $libros_mayores = libro_mayor ::all();
        $balance_general=balance_general::all();
        $balanza_de_comprobacion= balanza_de_comprobacion::all();
        $estado_de_capital=estado_de_capital::all();
        $estado_de_resultados=estado_de_resultados::all();

        $pdf = PDF::loadView('resultados.pdf.estados-financieros',['libros_diarios'=>$libros_diarios,'libros_mayores'=>$libros_mayores,'balance_general'=>$balance_general,'balanza_de_comprobacion'=>$balanza_de_comprobacion,'estado_de_capital'=>$estado_de_capital,'estado_de_resultados'=>$estado_de_resultados]);
        return $pdf->stream('informe_de_estados_financieros_'.date('d').'-'.date('m').'-'.date('y').'.pdf');
        /* return $pdf->download('informe_de_estados_financieros_'.date('d').'-'.date('m').'-'.date('y').'.pdf'); */
    }
}
