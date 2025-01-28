<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUserPosts extends Component
{
    use WithPagination;
    public string $campo="id", $orden="desc";
    public string $cadena="";

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
}
