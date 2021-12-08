<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Libros mayores') }}
        </h2>
        <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('inicio')}}">volver</a>
    </x-slot>
  <div class="flex justify-end ml-20 mr-20 pr-5">
      <a type="button"class=" pr-5 pl-5 mt-4  inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-10  justify-center items-center" href="{{route('libro_mayor/insertar')}}">Registrar nuevo libro mayor</a>
  </div>
  <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200  ">
    <thead>
        <tr class=" text-left border-b-2 border-gray-300  " >
            <th class="px-4 py-3">id</th> 
            <th class="px-4 py-3">Nombre denominacion</th>
            <th class="px-4 py-3">gestion</th>
            <th class="px-4 py-3">opciones</th>
        </tr>
    </thead>
    <tbody >
        
        @foreach ($libros_mayores as $item)
        <tr  class="bg-gray-300 border-b border-gray-200 text-gray-800">
            <td class="px-4 py-3">{{$item->id}}</td>
            <td class="px-4 py-3">{{$item->nombre_denominacion}}</td>
            <td class="px-4 py-3">{{$item->gestion}}</td>
            <td class="px-4 py-3">
                <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('libro_mayor/editar',$item)}}">editar</a><br>
                {{-- <form action="{{route('libro_mayor/del',$item)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 text-white rounded-full h-6 px-3 justify-center items-center" >Borrar</a>
                </form> --}}
            </td>
            @endforeach
        </tr>
    </tbody>
</table>    

</x-app-layout>