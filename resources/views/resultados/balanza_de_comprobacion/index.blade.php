<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Balanza de comprobacion') }} 
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('resultados')}}">volver</a>
    </x-slot>
    <div>
        <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
            <thead>
                <tr class=" text-left border-b-2 border-gray-300  " >
                    <th class="px-4 py-3">Código</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Deber</th>
                    <th class="px-4 py-3">Haber</th>
                    <th class="px-4 py-3">Saldo deudor</th>
                    <th class="px-4 py-3">Saldo acreedor</th>
                </tr>
            </thead>
            <tbody >
                
                @foreach ($balanza_de_comprobacion as $item)
                <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                    @if ($item->nombre_cuenta == 'total')
                    <td class="bg-blue-300 px-4 py-3"></td>
                    <td class="bg-blue-300 px-4 py-3">{{$item->nombre_cuenta}}</td>
                    <td class="bg-blue-300 px-4 py-3">{{$item->deber}}</td>
                    <td class="bg-blue-300 px-4 py-3">{{$item->haber}}</td>
                    <td class="bg-blue-300 px-4 py-3">{{$item->saldo_deudor}}</td>
                    <td class="bg-blue-300 px-4 py-3">{{$item->saldo_acreedor}}</td>
                    @else
                    <td class="px-4 py-3">{{$item->id_tipo_cuenta.'.'.$item->id_subtipo_cuenta.'.'.$item->id_cuenta}}</td>
                    <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                    <td class="px-4 py-3">{{$item->deber}}</td>
                    <td class="px-4 py-3">{{$item->haber}}</td>
                    <td class="px-4 py-3">{{$item->saldo_deudor}}</td>
                    <td class="px-4 py-3">{{$item->saldo_acreedor}}</td>
                    @endif    
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>   

</x-app-layout>
