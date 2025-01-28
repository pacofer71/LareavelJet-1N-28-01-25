<?php

namespace App\Livewire;

use Livewire\Component;

class Prueba extends Component
{
    public string $texto="Hola Mundo";
    public int $cont=0;
    public array $paises=['España', 'Alemania'];
    public string $pais="";

    public function render()
    {
        return view('livewire.prueba');
    }
    public function increment(){
        $this->cont++;
    }
    public function decrement(){
        $this->cont--;
    }

    public  function addPais(){
        $this->paises[]=$this->pais;
        $this->pais="";
    }
}
