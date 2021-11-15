{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('inicio') }}
        </h2>
    </x-slot>

    <div style="background-color:#F9FAFB ;margin-top:80px; margin-left:10%; margin-right:10%" >
        <div>

             <table class=" min-w-full divide-y divide-gray-200 " >
                        <thead style="background-color:#D1D5DB;">
                            <tr style="text-align: center;">
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">numero asiento</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">banderas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">deber</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">haber</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id cuenta</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id diario</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id mayor</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">glosa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">id user</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">opciones</th>
                            </tr>
                        </thead>
                        
                        
                        <tbody style="background-color:;">
                            @foreach ($asiento_contable as $item)
                            <tr >
                                <td class="px-6 py-4 whitespace-nowrap ">{{$item->id}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->numero_asiento}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->fecha}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->banderas}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->deber}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->haber}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->id_cuenta}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->id_diario}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->id_mayor}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->glosa}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{$item->id_user}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button>borrar</button><br>
                                    <button>añadir</button><br>
                                    <button>editar</button>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                        
            </table>
             
        </div>   
    </div>    

</x-app-layout>
 --}}