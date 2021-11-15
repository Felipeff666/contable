<x-app-layout>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              {{ __('Asientos contables') }}
          </h2>
          <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('inicio')}}">volver</a>
      </x-slot>
    <div class="flex justify-end ml-20 mr-20 pr-5">
        <a type="button"class=" pr-5 pl-5 mt-4  inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10  justify-center items-center" href="{{route('asiento_contable/insertar')}}">Registrar nuevo asiento contable</a>
    </div>
    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
        <thead>
            <tr class=" text-left border-b-2 border-gray-300  " >
                <th class="px-4 py-3">id</th>
                <th class="px-4 py-3">numero asiento</th>
                <th class="px-4 py-3">fecha</th>
                <th class="px-4 py-3">banderas</th>
                <th class="px-4 py-3">deber</th>
                <th class="px-4 py-3">haber</th>
                <th class="px-4 py-3">id cuenta</th>
                <th class="px-4 py-3">id diario</th>
                <th class="px-4 py-3">id mayor</th>
                <th class="px-4 py-3">glosa</th>
                <th class="px-4 py-3">id user</th>
                <th class="px-4 py-3">opciones</th>
            </tr>
        </thead>
        <tbody >
            
            @foreach ($asiento_contable as $item)
            <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
                <td class="px-4 py-3">{{$item->id}}</td>
                <td class="px-4 py-3">{{$item->numero_asiento}}</td>
                <td class="px-4 py-3">{{$item->fecha}}</td>
                <td class="px-4 py-3">{{$item->banderas}}</td>
                <td class="px-4 py-3">{{$item->deber}}</td>
                <td class="px-4 py-3">{{$item->haber}}</td>
                <td class="px-4 py-3">{{$item->id_cuenta}}</td>
                <td class="px-4 py-3">{{$item->id_diario}}</td>
                <td class="px-4 py-3">{{$item->id_mayor}}</td>
                <td class="px-4 py-3">{{$item->glosa}}</td>
                <td class="px-4 py-3">{{$item->id_user}}</td>
                <td class="px-4 py-3">
                    <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('asiento_contable/editar')}}">editar</a>
                    <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="">Borrar</a>
                </td>
                @endforeach
            </tr>
        </tbody>
        
    </table>    
    
  </x-app-layout>