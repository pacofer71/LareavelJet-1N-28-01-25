<?php

namespace App\Livewire;

use Livewire\Component;

class CrearPost extends Component
{
    public bool $openModalCrear=false;

    public function render()
    {
        return view('livewire.crear-post');
    }

    public function abrirModal(){
        $this->openModalCrear=true;
    }
}
