<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination;
    public string $campo="id", $orden="desc";
    public string $cadena="";

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
}
