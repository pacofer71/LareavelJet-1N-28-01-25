<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCreatePost extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:60', 'unique:posts,titulo'])]
    public string $titulo="";
    
    #[Validate(['required', 'string', 'min:10', 'max:250'])]
    public string $contenido="";
    
    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado="";
    
    #[Validate(['nullable', 'image', 'max:4096'])]
    public $imagen;
    /*  Podiamos haber hecho esto asi y no con las anotaciones
    public function rules(){
        return([
            'titulo'=>[]
        ])
    } 
        */
    public function fGuardarPost(){
        $this->validate();
    }

}
