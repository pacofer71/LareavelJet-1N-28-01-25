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
    //---------------------------------------
    public function store(){
        $this->form->fGuardarPost();
        //creamos un evento dirigido a la clase ShowUserPost
        //Para notificar que se renderice
        $this->dispatch('onPostCreado')->to(ShowUserPosts::class);
        //creo un evento global para sweetalert 2
        $this->dispatch('mensaje', "Se guardó el post");
        
        $this->cancelar();
    }

    public function cancelar(){
        $this->openModalCrear=false;
        $this->form->fLimpiar();
    }
}
