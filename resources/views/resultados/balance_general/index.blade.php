<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Balance general') }} 
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('resultados')}}">volver</a>
    </x-slot>
    <div >
        {{-- <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
            <thead>
                <tr class=" text-left border-b-2 border-gray-300  " >
                    <th class="px-4 py-3">Codigo de tipo cuenta</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Deber</th>
                    <th class="px-4 py-3">Haber</th>
                </tr>
            </thead>
            <tbody >
                
                @foreach ($balance_general as $item)
                <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">    
                    <td class="px-4 py-3">{{$item->id_tipo_cuenta}}</td>
                    <td class="px-4 py-3">{{$item->nombre_cuenta}}</td>
                    <td class="px-4 py-3">{{$item->deber}}</td>
                    <td class="px-4 py-3">{{$item->haber}}</td>  
                    @endforeach
                </tr>
            </tbody>
        </table> --}}
        
        <div>
            <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
                <thead>
                    <tr class=" text-left border-b-2 border-gray-300  " >
                        <th class="px-4 py-3">Codigo de tipo cuenta</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Deber</th>
                        <th class="px-4 py-3">Haber</th>
                    </tr>
                </thead>
                <tbody >
                    
                    @foreach ($balance_general as $item)
                    @if ($item->nombre_cuenta =='total pasivos y capital' || $item->nombre_cuenta == 'total activos')

                        <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">    
                            <td class=" bg-green-200 px-4 py-3"></td>
                            <td class=" bg-green-200 px-4 py-3">{{$item->nombre_cuenta}}</td>
                            <td class=" bg-green-200 px-4 py-3">{{$item->deber}}</td>
                            <td class=" bg-green-200 px-4 py-3">{{$item->haber}}</td>  
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

</x-app-layout>