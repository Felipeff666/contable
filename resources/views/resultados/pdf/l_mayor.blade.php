<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libro diario</title>
    <style>
        .resultados{
            background-color: #d1d5db;
        }
        .centrado{
            text-align: right;
        }
    </style>
</head>
<body>
    <div  class=" border-solid border-4 border-gray-800 ml-7 mr-7 mt-5 ">
        @foreach ($libro_mayor as $item)
            @if ($item->id == '1')
                <h3 style="text-align: center; " class="flex justify-center text-gray-800 font-serif text-2xl mt-5 ">INFORME DE ESTADOS FINANCIEROS: {{$item->nombre_denominacion}} </h3><br>
                <p style="margin:0px; " class="flex justify-start text-gray-800 font-serif text-2xl ml-7">Fecha de apertura: {{$item->gestion}} </p>
                
            @endif
            
        @endforeach
        
    </div>
    <div style="margin-top:20px">
        <table border="solid 1" align="center" style="width: 600px" class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
            <thead style="background-color: #9CA3AF">
                <tr class=" text-left border-b-2 border-gray-300  " >
                    <th class="px-4 py-3">id cuenta</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Deber</th>
                    <th class="px-4 py-3">Haber</th>
                    <th class="px-4 py-3">Saldo deudor</th>
                    <th class="px-4 py-3">Saldo acreedor</th>
                </tr>
            </thead>
            <tbody style="background-color:whitesmoke" >
                
                @foreach ($res_l_mayor as $item)
                <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">

                    <td class="px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id_cuenta}}</td>
                    <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                    <td class="px-4 py-3">{{$item->deber}}</td>
                    <td class="px-4 py-3">{{$item->haber}}</td>
                    <td class="resultados bg-blue-300 px-4 py-3">{{$item->saldo_deudor}}</td>
                    <td class="resultados bg-blue-300 px-4 py-3">{{$item->saldo_acreedor}}</td>
                       
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    
</body>
</html>