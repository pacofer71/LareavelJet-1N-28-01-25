<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCreatePost;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPost extends Component
{
    //Para manejar la subida de ficheros
    use WithFileUploads;

    public FormCreatePost $form;

    public bool $openModalCrear=false;

    public function render()
    {
        return view('livewire.crear-post');
    }

    public function abrirModal(){
        $this->openModalCrear=true;
    }
}
