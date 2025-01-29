<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdatePost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo="id", $orden="desc";
    public string $cadena="";

    public FormUpdatePost $uform;
    public bool $abrirModalUpdate=false;


    #[On('onPostCreado')]    
    public function render()
    {
        $posts=Post::where('user_id', Auth::user()->id)
        ->where(function($query){
            $query->where('titulo', 'like', "%{$this->cadena}%")
            ->orWhere('contenido', 'like', "%{$this->cadena}%")
            ->orWhere('estado', 'like', "%{$this->cadena}%");
        })
        ->orderBy($this->campo, $this->orden)
        ->paginate(5);
        return view('livewire.show-user-posts', compact('posts'));
    }

    //Metodo para que busqueda funcione en todas las paginas si paginamos
    public function updatingCadena(){
        $this->resetPage();
    }


    public function ordenar(string $campo){
        $this->orden=($this->orden=='desc') ? 'asc' : 'desc';
        $this->campo=$campo;
    }
    //Para borrar posts --------------------------------------------
    public function mostrarAlerta(Post $post){
        $this->authorize('delete', $post);
        $this->dispatch('alertaBorrar', $post->id);     
    }
    #[On('onBorrarConfirmado')]
    public function destroy(Post $post){
        $this->authorize('delete', $post);
        if(basename($post->imagen!='default.webp')){
            Storage::delete($post->imagen);
        }
        $post->delete();
        $this->dispatch('mensaje', "Se eliminó el Post");

    }
    //-------------------------------------------------------------
    //Para editar el estado de un post
    public function updateEstado(Post $post){
        $this->authorize('update', $post);

        $estado=($post->estado=='Publicado') ? 'Borrador' : 'Publicado';
        $post->update([
            'estado'=>$estado,
        ]);
    }
    // Para actualizar un posts
    public function edit(Post $post){
        $this->authorize('update', $post);

        $this->uform->setPost($post);
        $this->abrirModalUpdate=true;

    }
    public function update(){
        $this->uform->fUpdatePost();
        $this->dispatch('mensaje', 'Post Editado');
        $this->cancelar();  
    }
    public function cancelar(){
        $this->abrirModalUpdate=false;
        $this->uform->fCancelar();
    }
}
