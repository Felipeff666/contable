<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Libro diario') }} 
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('resultados')}}">volver</a>
    </x-slot>
    <div>
        <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
            <thead>
                <tr class=" text-left border-b-2 border-gray-300  " >
                    
                    <th class="px-2 py-1">numero asiento</th>
                    <th class="px-7 py-6">fecha</th>
                    <th class="px-2 py-1">id cuenta</th>
                    <th class="px-4 py-3">cuenta</th>
                    <th class="px-4 py-3">deber</th>
                    <th class="px-4 py-3">haber</th>
                    <th class="px-4 py-3">glosa</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($res_l_diario as $item)
                <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                    @if ($item->nombre_cuenta == 'total')
                    
                        <td class="bg-blue-300 px-4 py-3"></td>
                        <td class="bg-blue-300 px-4 py-3">{{$item->numero_asiento}}</td>
                        <td class="bg-blue-300 px-4 py-3"></td>
                    @foreach ($plan_de_cuentas as $item2)
                        @if ($item2->nombre == $item->nombre_cuenta)
                            <td class="bg-blue-300 px-4 py-3">{{$item2->id_tipo_cuenta}}.{{$item2->id_subtipo_cuenta}}.{{$item2->id}}</td>
                        @endif
                    @endforeach
                        <td class="bg-blue-300 px-4 py-3">{{$item->nombre_cuenta}}</td>
                        <td class="bg-blue-300 px-4 py-3">{{$item->deber}}</td>
                        <td class="bg-blue-300 px-4 py-3">{{$item->haber}}</td>
                        <td class="bg-blue-300 px-4 py-3">{{$item->glosa}}</td>
                    
                    @else

                        <td class="px-4 py-3">{{$item->numero_asiento}}</td>
                        <td class="px-4 py-3">{{$item->fecha}}</td>
                    @foreach ($plan_de_cuentas as $item2)
                        @if ($item2->nombre == $item->nombre_cuenta)
                            <td class="px-4 py-3">{{$item2->id_tipo_cuenta}}.{{$item2->id_subtipo_cuenta}}.{{$item2->id}}</td>
                        @endif
                    @endforeach
                        <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                        <td class="px-4 py-3">{{$item->deber}}</td>
                        <td class="px-4 py-3">{{$item->haber}}</td>
                        <td class="px-4 py-3">{{$item->glosa}}</td>
                    
                    @endif    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>   

</x-app-layout>