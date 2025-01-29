<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdatePost extends Form
{
    public ?Post  $post=null;
    public string $titulo="";
    
    #[Validate(['required', 'string', 'min:10', 'max:250'])]
    public string $contenido="";
    
    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado="";
    
    #[Validate(['nullable', 'image', 'max:4096'])]
    public $imagen;

    public function rules(){

        return [
            'titulo'=>['required', 'string', 'min:3', 'max:60', 'unique:posts,titulo,'.$this->post->id]
        ];
    }

    public function setPost(Post $post){
        $this->post=$post;
        $this->titulo=$post->titulo;
        $this->contenido=$post->contenido;
        $this->estado=$post->estado;
        //$this->imagen=$post->imagen; Es un fichero
    }

    public function fUpdatePost(){
        $this->validate();
        $imagenVieja=$this->post->imagen;
        $this->post->update([
            'titulo'=>$this->titulo,
            'contenido'=>$this->contenido,
            'estado'=>$this->estado,
            'imagen'=>($this->imagen) ? $this->imagen->store('posts-images') : $imagenVieja
        ]);
        if($this->imagen && basename($imagenVieja)!='default.webp'){
            Storage::delete($imagenVieja);
        }
    }

    public function fCancelar(){
        $this->reset();
    }
}
