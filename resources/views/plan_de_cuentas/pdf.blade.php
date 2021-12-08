<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plan de cuentas</title>
    <style>
        .centrado{
            text-align: center;
        }
        thead{
            background-color: #9CA3AF;
        }
    </style>
</head>
<body>
    <div>
        <div class="centrado">
            <h3>PLAN DE CUENTAS Colegio ABC</h3>
        </div>
        <div>
            <table border="solid 1"  align="center" style="width: 600px"class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                <thead >
                    <tr class=" text-left border-b-2 border-gray-300  " >
                        <th class="px-4 py-3">Código</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Descripcion</th>

                    </tr>
                </thead>
                <tbody >
                    
                    @foreach ($plan_de_cuentas as $item)
                    <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                        <td class="px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id}}</td>
                        <td class="px-4 py-3">{{$item->nombre}}</td>
                        <td class="px-4 py-3">{{$item->descripcion}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</body>
</html>