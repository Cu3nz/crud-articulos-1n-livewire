<div>

    <x-propios.principal>

        <div class="flex w-full mb-1 items-center">

            <div class="flex-1">
                <x-input placeholder="Busca un articulo" class="w-3/4" wire:model.live="buscar"></x-input>
            </div>

            <div>
                @livewire('crear-article') {{-- todo Boton que se va a encargar de cargar la modal de create --}}
            </div>

        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if (count($articles)){{-- todo Si hay articulos me muestras la tabla --}}
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-16 py-3">
                            <span class="sr-only">Imagen</span>
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('article_nombre')">
                            <i class="fas fa-sort mr-1"></i>Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')" >
                            <i class="fas fa-sort mr-1"></i>Estado
                        </th>
                        <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('category_nombre')" >
                            <i class="fas fa-sort mr-1"></i>Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $item)   
                    <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{Storage::url($item -> imagen)}}" class="w-16 md:w-32 max-w-full max-h-full"
                                alt="Apple Watch">
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 cursor-pointer dark:text-white">
                            {{$item -> article_nombre}} {{-- todo El nombre del alias que haya puesto en la consulta --}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                {{$item -> descripcion_article}} {{-- todo Tengo que definir el nombre del alias que haya puesto en la consulta --}}
                            </div>
                        </td>
                        <td  @class(["px-6 py-4 font-semibold cursor-pointer  ",
                        "text-green-600" => $item -> estado == "DISPONIBLE",
                        "text-red-600" => $item -> estado == "NO DISPONIBLE"]) wire:click="cambiarEstadoClick({{$item -> id}})">
                            {{$item -> estado}}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{$item -> category_nombre}}  {{-- todo Tengo que definir el nombre del alias que haya puesto en la consulta --}}
                        </td>
                        <td class="px-6 py-4">
                           <button wire:click="pedirConfirmacion({{$item -> id}})"><i class="fas fa-trash text-red-600"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else {{-- ! Si no mostramos este mensaje de aviso --}}
            <p class="mt-4">No se ha encontrado el articulo que estas buscando.</p>
            @endif
        </div>
        <div class="my-2">
        {{$articles -> links()}}   {{-- *Añadimos la paginacion --}}
        </div>        
    </x-propios.principal>
    
</div>
