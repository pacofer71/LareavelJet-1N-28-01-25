<x-self.base>
    <div class="flex w-full items-center justify-between">
        <div>
            <x-input type="search" placeholder="Buscar..." wire:model.live="cadena" /><i class="fas fa-search"></i>
        </div>
        <div>
            @livewire('crear-post')
        </div>
    </div>
    @if($posts->count())
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Imagen</span>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                        Título<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('contenido')">
                        Contenido<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')">
                        Estado<i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{Storage::url($item->imagen)}}" class="w-16 md:w-32 max-w-full max-h-full" alt="">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        {{$item->titulo}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->contenido}}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        <button @class([ 'p-2 rounded-xl text-white font-bold' , 'bg-red-500 hover:bg-red-700'=>$item->estado=='Borrador',
                            'bg-green-500 hover:bg-green-700'=>$item->estado=='Publicado',
                            ]) wire:click="updateEstado({{$item->id}})">
                            {{$item->estado}}
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{$item->id}})"><i class="fas fa-edit mr-1 text-green-500 text-lg hover:text-xl"></i></button>
                        <button wire:click="mostrarAlerta({{$item->id}})"><i class="fas fa-trash text-red-500 text-lg hover:text-xl"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{$posts->links()}}
    </div>
    @else
    <div class="bg-black text-white p-2 rounded-xl font-semibold mt-2">
        No se encontró ningún post o aun no ha escrito ninguno. Aproveche para crear el post de sus sueños.
    </div>
    @endif
    <!----------------------------- Modal para editar Posts ---------- -->
    @isset($uform->post)
    <x-dialog-modal maxWidth='4xl' wire:model="abrirModalUpdate">
        <x-slot name="title">
            EDITAR POST
        </x-slot>
        <x-slot name="content">
            <!-- Campo Título -->
            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-medium mb-2">Título</label>
                <input type="text" id="titulo" name="titulo" wire:model="uform.titulo"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingrese el título del post" required>
                <x-input-error for="uform.titulo" />
            </div>

            <!-- Campo Contenido -->
            <div class="mb-4">
                <label for="contenido" class="block text-gray-700 font-medium mb-2">Contenido</label>
                <textarea id="contenido" name="contenido" rows="4" wire:model="uform.contenido"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe el contenido del post" required></textarea>
                <x-input-error for="uform.contenido" />
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Estado</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model="uform.estado" id="publicado" name="estado" value="Publicado" class="text-blue-500" required>
                        <span class="text-gray-700">Publicado</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" id="borrador" wire:model="uform.estado" name="estado" value="Borrador" class="text-blue-500" required>
                        <span class="text-gray-700">Borrador</span>
                    </label>
                </div>
                <x-input-error for="uform.estado" />
            </div>
            <!-- Imagen mucho  -->

            <label class="block text-gray-700 font-medium mb-2" for="uimagen">Imagen</label>
            <div class="w-full h-96 bg-gray-200 relative rounded-lg">
                <label for="uimagen"
                    class="absolute bottom-2 end-2 p-2 rounded-xl bg-gray-700 hover:bg-black text-white font-bold">
                    <i class="fas fa-upload mr-2"></i>Subir
                </label>
                <input type="file" wire:model="uform.imagen" accept="image/*" name="imagen" id="uimagen" hidden />
                @isset($uform->imagen)
                <img src="{{$uform->imagen->temporaryUrl()}}" class="bg-no-repeat bg-cover w-full h-full bg-center">
                @else
                <img src="{{Storage::url($uform->post->imagen)}}" class="bg-no-repeat bg-cover w-full h-full bg-center">
                @endisset
            </div>
            <x-input-error for="uform.imagen" />
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-between">
                <button type="submit" wire:click="update" wire:loading.attr="hidden"
                    class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Enviar</button>
                <button type="button" wire:click="cancelar" class=" mx-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancelar</button>
            </div>
        </x-slot>
    </x-dialog-modal>
    @endisset
</x-self.base>