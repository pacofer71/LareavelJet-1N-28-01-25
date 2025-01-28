<div>
    <x-button wire:click="$set('openModalCrear', true)"><i class="fas fa-add mr-1"></i>Nuevo</x-button>
    <x-dialog-modal maxWidth='4xl' wire:model="openModalCrear">
        <x-slot name="title">
            Nuevo Post
        </x-slot>
        <x-slot name="content">
            <!-- Campo Título -->
            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-medium mb-2">Título</label>
                <input type="text" id="titulo" name="titulo" wire:model="form.titulo" 
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingrese el título del post" required>
                <x-input-error for="form.titulo" />
            </div>

            <!-- Campo Contenido -->
            <div class="mb-4">
                <label for="contenido" class="block text-gray-700 font-medium mb-2">Contenido</label>
                <textarea id="contenido" name="contenido" rows="4" wire:model="form.contenido" 
                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Escribe el contenido del post" required></textarea>
                <x-input-error for="form.contenido" />
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Estado</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" wire:model="form.estado" id="publicado" name="estado" value="Publicado" class="text-blue-500" required>
                        <span class="text-gray-700">Publicado</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" id="borrador" wire:model="form.estado" name="estado" value="Borrador" class="text-blue-500" required>
                        <span class="text-gray-700">Borrador</span>
                    </label>
                </div>
                <x-input-error for="form.estado" />
            </div>
            <!-- Imagen -->
            <label class="block text-gray-700 font-medium mb-2" for="cimagen">Imagen</label>
            <div class="w-full h-96 bg-gray-200 relative rounded-lg">
                <label for="cimagen"
                    class="absolute bottom-2 end-2 p-2 rounded-xl bg-gray-700 hover:bg-black text-white font-bold">
                    <i class="fas fa-upload mr-2"></i>Subir
                </label>
                <input type="file" wire:model="form.imagen" accept="image/*" name="imagen" id="cimagen" hidden />
                @isset($form->imagen)
                <img src="{{$form->imagen->temporaryUrl()}}" class="bg-no-repeat bg-cover w-full h-full bg-center">
                @endisset
            </div>
            <x-input-error for="form.imagen" />
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Enviar</button>
                <button type="button" class=" mx-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancelar</button>
                <button type="reset" class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">Reset</button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>