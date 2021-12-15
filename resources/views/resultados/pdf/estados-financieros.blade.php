<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estados Financieros</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ public_path('css/app.css')}}"           type="text/css"> --}}
    {{-- <link rel="stylesheet" href="{{ public_path('css/tailwind.min.css') }}" type="text/css"> --}}
    <style>
        .page-break {
            page-break-after: always;
        }
        .resultados{
            background-color: #d1d5db;
        }
        .centrado{
            text-align: right;
        }
    </style>
</head>
<body>
    <div>
        <div  class=" border-solid border-4 border-gray-800 ml-7 mr-7 mt-5 ">
            @foreach ($libros_diarios as $item)
                @if ($item->id == '1')
                    <h3 style="text-align: center; " class="flex justify-center text-gray-800 font-serif text-2xl mt-5 ">INFORME DE ESTADOS FINANCIEROS: {{$item->nombre_denominacion}} </h3><br>
                    <p style="margin:0px; " class="flex justify-start text-gray-800 font-serif text-2xl ml-7">Fecha de apertura: {{$item->fecha_apertura}} </p><br>
                    <p style="margin:0px; " class="flex justify-start text-gray-800 font-serif text-2xl ml-7 mb-5">Fecha de cierre: {{$item->fecha_cierre}}</p>
                @endif
                
            @endforeach
            
        </div>

        <div  class=" border-solid border-4 border-gray-800 ml-7 mr-7 mt-3 mb-5">

            <div >
            <div style="text-align: center; ">
                <h3 class="flex justify-center text-gray-800 font-serif text-2xl  mt-7">Balanza de comprobacion</h3>
            </div>
            <div>
                <table border="solid 1" align="center" style="width: 600px"  class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                    <thead style="background-color: #9CA3AF">
                        <tr class=" text-left border-b-2 border-gray-300  " >
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Deber</th>
                            <th class="px-4 py-3">Haber</th>
                            <th class="px-4 py-3">Saldo deudor</th>
                            <th class="px-4 py-3">Saldo acreedor</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:whitesmoke" >
                        
                        @foreach ($balanza_de_comprobacion as $item)
                        <tr class="bg-gray-300 border-b border-gray-200 text-gray-800">
                            @if ($item->nombre_cuenta == 'total')
                            <td class=" resultados bg-blue-300 px-4 py-3"></td>
                            <td class=" resultados bg-blue-300 px-4 py-3">{{$item->nombre_cuenta}}</td>
                            <td class=" resultados bg-blue-300 px-4 py-3">{{$item->deber}}</td>
                            <td class=" resultados bg-blue-300 px-4 py-3">{{$item->haber}}</td>
                            <td class=" resultados bg-blue-300 px-4 py-3">{{$item->saldo_deudor}}</td>
                            <td class=" resultados bg-blue-300 px-4 py-3">{{$item->saldo_acreedor}}</td>
                            @else
                            <td class=" px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id_cuenta}}</td>
                            <td class=" px-4 py-3">{{$item->nombre_cuenta}}</td>
                            <td class=" px-4 py-3">{{$item->deber}}</td>
                            <td class=" px-4 py-3">{{$item->haber}}</td>
                            <td class=" px-4 py-3">{{$item->saldo_deudor}}</td>
                            <td class=" px-4 py-3">{{$item->saldo_acreedor}}</td>
                            @endif    
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>   
            </div>


            <div class="page-break">
            <div style="text-align: center; ">
                <h3 class="flex justify-center text-gray-800 font-serif text-2xl mt-7">Estado de resultados</h3>
            </div>
            <div>
                <table border=" solid 1"  align="center" style="width: 600px" class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                    <thead style="background-color:#9CA3AF">
                        <tr class=" text-left border-b-2 border-gray-300  " >
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Saldo deudor</th>
                            <th class="px-4 py-3">Saldo acreedor</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:whitesmoke">
                        
                        @foreach ($estado_de_resultados as $item)
                        <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                            @if ($item->nombre_cuenta == 'Utilidad Neta')
                            <td  class=" resultados bg-green-200 px-4 py-3"></td>
                            <td  class=" resultados bg-green-200 px-4 py-3">{{$item->nombre_cuenta}}</td>
                            <td  class=" resultados bg-green-200 px-4 py-3"></td>
                            <td  class=" resultados bg-green-200 px-4 py-3">{{$item->saldo_acreedor}}</td>
                            @else
                                @if ($item->nombre_cuenta == 'totales')
                                <td  class=" resultados bg-blue-300 px-4 py-3"></td>
                                <td  class=" resultados bg-blue-300 px-4 py-3">{{$item->nombre_cuenta}}</td>
                                <td  class=" resultados bg-blue-300 px-4 py-3">{{$item->saldo_deudor}}</td>
                                <td  class=" resultados bg-blue-300 px-4 py-3">{{$item->saldo_acreedor}}</td>
                                @else
                                <td class="px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id_cuenta}}</td>
                                <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                                <td class="px-4 py-3">{{$item->saldo_deudor}}</td>
                                <td class="px-4 py-3">{{$item->saldo_acreedor}}</td>
                                @endif 
                            @endif   
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div> 
            </div>


            <div >
            <div style="text-align: center; ">
                <h3 class="flex justify-center text-gray-800 font-serif text-2xl mt-7">Estado del capital contable</h3>
            </div>
            <div>
                <table border=" solid 1"  align="center" style="width: 600px" class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                    <thead style="background-color: #9CA3AF">
                        <tr class=" text-left border-b-2 border-gray-300  " >
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Saldo deudor</th>
                            <th class="px-4 py-3">Saldo acreedor</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:whitesmoke">
                        
                        @foreach ($estado_de_capital as $item)
                        <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                            @if ($item->nombre_cuenta == '-total')
                            <td  class=" resultados bg-green-200 px-4 py-3"></td>
                            <td  class=" resultados bg-green-200 px-4 py-3">{{$item->nombre_cuenta}}</td>
                            <td  class=" resultados bg-green-200 px-4 py-3"></td>
                            <td  class=" resultados bg-green-200 px-4 py-3">{{$item->haber}}</td>
                            @else
                                @if ($item->nombre_cuenta == 'Utilidad Neta')
                                <td class="resultados bg-blue-300 px-4 py-3"></td>
                                <td class="resultados bg-blue-300 px-4 py-3">{{$item->nombre_cuenta}}</td>
                                <td class="resultados bg-blue-300 px-4 py-3"></td>
                                <td class="resultados bg-blue-300 px-4 py-3">{{$item->haber}}</td>
                                @else
                                <td class="px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id_cuenta}}</td>
                                <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                                <td class="px-4 py-3">{{$item->deber}}</td>
                                <td class="px-4 py-3">{{$item->haber}}</td>
                                @endif 
                            @endif   
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div> 
            </div>


            <div >
            <div style="text-align: center; ">
                <h3 class="flex justify-center text-gray-800 font-serif text-2xl mt-7">Balance general</h3>
            </div>
            <div>
                    <table border="solid 1"  align="center" style="width: 600px" class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                        <thead style="background-color: #9CA3AF">
                            <tr class=" text-left border-b-2 border-gray-300  " >
                                <th class="px-4 py-3">Codigo de tipo cuenta</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Deber</th>
                                <th class="px-4 py-3">Haber</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:whitesmoke">
                            
                            @foreach ($balance_general as $item)
                            @if ($item->nombre_cuenta =='total pasivos y capital' || $item->nombre_cuenta == 'total activos')
        
                                <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">    
                                    <td class="resultados bg-green-200 px-4 py-3"></td>
                                    <td class="resultados bg-green-200 px-4 py-3">{{$item->nombre_cuenta}}</td>
                                    <td class="resultados bg-green-200 px-4 py-3">{{$item->deber}}</td>
                                    <td class="resultados bg-green-200 px-4 py-3">{{$item->haber}}</td>  
                                </tr> 
                            @else
                                    @if ( $item->nombre_cuenta =='total capital')
                                        <tr class="bg-gray-300 border-b border-gray-200 text-gray-800">    
                                            <td class=" bg-blue-300 px-4 py-3">{{$item->id_tipo_cuenta}}</td>
                                            <td class=" bg-blue-300 px-4 py-3">{{$item->nombre_cuenta}}</td>
                                            <td class=" bg-blue-300 px-4 py-3">{{$item->deber}}</td>
                                            <td class=" bg-blue-300 px-4 py-3">{{$item->haber}}</td>  
                                        </tr> 
                                    @else
                                        <tr class="bg-gray-300 border-b border-gray-200 text-gray-800">    
                                            <td class="px-4 py-3">{{$item->id_tipo_cuenta}} @if ($item->id_tipo_cuenta == '1') Activo @else Pasivo
                                            @endif </td>
                                            <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                                            <td class="px-4 py-3">{{$item->deber}}</td>
                                            <td class="px-4 py-3">{{$item->haber}}</td>  
                                        </tr> 
                                    @endif   
                            @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                    
            </div>
            </div>


        </div>
    </div>
</body>
</html>