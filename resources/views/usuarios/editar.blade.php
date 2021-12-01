<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar  usuarios') }}
        </h2>
        {{-- <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-700 hover:bg-gray-500 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('inicio')}}">volver</a> --}}
    </x-slot>
    <x-guest-layout>
        <x-jet-authentication-card >
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('usuarios/editar/edit',$usuarios) }}">
            @csrf
            @method('put')
            <div>
                
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$usuarios->name}}" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$usuarios->email}}" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="rol" value="{{ __('rol') }}" />
                <select class="block mt-1 w-full p-2 h-10 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="rol" id="rol">
                        @foreach ($roles as $item)
                        @if ($item->id == $usuarios->current_team_id)
                            <option  value="{{$item->id}} "selected >
                                {{$item->nombre}}
                             </option>

                        @else 
                             <option  value="{{$item->id}}">
                                 {{$item->nombre}}
                             </option>
                        @endif
                    @endforeach
                    
                </select>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a type="button"class=" pr-5 pl-5 mt-1 inline-flex bg-gray-800 text-white rounded-full h-6 px-3 justify-center items-center" href="{{route('usuarios')}}">volver</a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
        </x-jet-authentication-card>
    </x-guest-layout>
</x-app-layout>