<div>
  
    <x-button wire:click="$set('abrirModalCreate' , true)">Crear nuevo Articulo</x-button>  {{-- * Crea el boton que se mostrara alado del input de tipo search --}}

    {{-- ? todo la modal tiene 3 atributos que se tienen que pasar mediante el componente x-slot y el name --}}
    <x-dialog-modal wire:model="abrirModalCreate"> {{-- todo Aqui pondremos el atributo wire:model="abrirModalCreate", la cual valida que si el valor de abrirModalCreate es false no se abra la modal automaticamente solo cuando se pulse el boton  de crear nuevo articulo  --}}
        <x-slot name="title">
        
            Crear nuevo producto
            
        </x-slot>
    
        <x-slot name="content">

            <x-label for="nombre" class="font-bold mt-3">Titulo</x-label>
            <x-input placeholder="Añade el titulo del libro" class="w-full mt-3" wire:model="nombre"></x-input>
            <x-input-error for="nombre"></x-input-error>

            <x-label for="descripcion" class="font-bold mt-3">Descripcion</x-label>
            <textarea name="" wire:model="descripcion" id="descripcion" cols="30"rows="" class="w-full mt-3"></textarea>
            <x-input-error for="descripcion"></x-input-error>


            <x-label for="estado" class="font-bold mt-3">Estado</x-label>
            <div class="flex items-center">
                <input id="estado" type="checkbox" wire:model="estado" value="DISPONIBLE"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" wire:model="estado">Disponible
                
                    <x-input-error for="estado"></x-input-error>

            </div>

            <x-label for="category_id">Categoria</x-label>
            <select class="w-full mt-3" name="" id="category_id"  wire:model="category_id">
                <Option> Elige una opcion</Option>
                @foreach ($categorias as $category)
                    <option value="{{$category -> id}}">{{$category -> nombre}}</option>
                @endforeach
            </select>
            <x-input-error for="category_id"></x-input-error>

            <x-label for="imagenC">Imagen</x-label>
            <div class="w-full h-80 bg-gray-200 relative">
                <input type="file" name="" hidden accept="image/*" wire:model="imagen" id="imagenC">
                @if ($imagen)   
                <img src="{{ $imagen->temporaryUrl() }}" class="w-full h-full bg-center bg-cover bg-no-repeat"
                alt="">
                @endif
                <label for="imagenC"
                    class="absolute bottom-2 right-2 bg-gray-700 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">SUBIR</label>
            </div>
            <x-input-error for="imagenC"></x-input-error>
        </x-slot>
    

        <x-slot name="footer">
            <button wire:click="store" wire:loading.attr="disabled"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save"></i> GUARDAR
            </button>
            <button class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" wire:click="CerrarModalCreate">
                <i class="fas fa-xmark"></i> CANCELAR</button>
        </x-slot>
    </x-dialog-modal>

</div>
