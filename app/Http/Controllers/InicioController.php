<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicio(){
        $posts=Post::with('user')->where('estado', 'Publicado')->paginate(5);
        return view('welcome', compact('posts'));
    }
}
