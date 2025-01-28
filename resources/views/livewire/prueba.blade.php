<x-self.base>
    <x-button class="mr-2" wire:click="decrement">-</x-button>
    {{$cont}}
    <x-button class="ml-2" wire:click="increment">+</x-button>
    <div class="mt-2">
        <p>{{$pais}}</p>
        <x-input placeholder="Ingresa in pais..." wire:model.blur="pais" /><x-button>ENVIAR</x-button>
        <ul>
        @foreach ($paises as $pais)
        <li>{{$pais}}</li>    
        @endforeach
        </ul>
    </div>
</x-self.base>