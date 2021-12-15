<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asientos Contables</title>
    <style>
        .centrado{
            text-align: center;
        }
        thead{
            background-color: #9CA3AF;
        }
        td{
            border: solid 1 red;
        }
        .sm{
            width: 10px;
        }
    </style>
</head>
<body>
    <div>
        <div class="centrado">
            <h3>ASIENTOS CONTABLES Colegio ABC</h3>
        </div>
        <div>
            <table border=" solid 1" align="center" class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                <thead>
                    <tr class=" text-center border-b-2 border-gray-300  " >
                        {{-- <th class=" sm px-4 py-3">id</th> --}}
                        <th class=" sm px-2 py-1">numero asiento</th>
                        <th class=" px-7 py-6">fecha</th>
                        {{-- <th class=" sm px-2 py-1">banderas</th> --}}
                        <th class="sm  px-4 py-3"> id cuenta</th>
                        <th class="sm  px-4 py-3">cuenta</th>
                        <th class="  px-4 py-3">deber</th>
                        <th class="  px-4 py-3">haber</th>
                        {{-- <th class="px-2 py-1">id diario</th>
                        <th class="px-2 py-1">id mayor</th> --}}
                        <th class="px-4 py-3">glosa</th>
                        <th class="px-4 py-3">usuario</th>
                        
                    </tr>
                </thead>
                <tbody >
                    
                    @foreach ($asiento_contable as $item)
                    <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                        {{-- <td class=" sm px-4 py-3">{{$item->id}}</td> --}}
                        <td class=" sm px-4 py-3">{{$item->numero_asiento}}</td>
                        <td class=" px-1 py-1 text-sm">{{$item->fecha}}</td>
                        @foreach ($plan_de_cuentas as $item1)
                            @if ($item->id_cuenta == $item1->id)
                                <td class=" sm px-1 py-1 text-sm">{{$item1->id_tipo_cuenta}}.{{$item1->id_subtipo_cuenta}}.{{$item1->id}}</td>
                            @endif
                        @endforeach

                        @foreach ($cuentas as $item2)
                            @if ($item->id_cuenta == $item2->id)
                                <td class=" sm px-1 py-1 text-sm">{{$item2->nombre}}</td>
                            @endif
                        @endforeach
                        {{-- <td class=" sm px-4 py-3">{{$item->banderas}}</td> --}}
                        <td class="  px-4 py-3">{{$item->deber}}</td>
                        <td class="  px-4 py-3">{{$item->haber}}</td>
                        {{-- <td class="px-4 py-3">{{$item->id_cuenta}}</td> --}}
                        
                        {{-- <td class="px-4 py-3">{{$item->id_diario}}</td>
                        <td class="px-4 py-3">{{$item->id_mayor}}</td> --}}
                        <td class="px-2 py-1 text-sm">{{$item->glosa}}</td>
                        {{-- <td class="px-4 py-3">{{$item->id_user}}</td> --}}
                        @foreach ($users as $item3)
                        @if ($item->id_user == $item3->id)
                             <td class="px-1 py-1 text-sm">{{$item3->name}}</td>
                        @endif
                        @endforeach
                        @endforeach
                    </tr>
                </tbody>
                
            </table>  
        </div>

    </div>
</body>
</html>