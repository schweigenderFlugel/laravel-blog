<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    # Importante: para que los controladores puedan visualizar las vistas, necesitamos especificar las rutas 
    # en routes/web.php
    public function index()
    {
        # Este método retorna la vista

        # Obtener los artículos públicos (1)
        $articles = Article::where('status', '1') # Esto expresa la condición en la que se encuentra los artículos: público
                    ->orderBy('id', 'desc') # Para ordernarlos por id de forma descendente
                    ->simplePaginate(10); # Para mostrar 10 artículos en la página principal

        # Obtener las categorías en estado público (1) y destacadas
        $navbar = Category::where([
            ['status', '1'], # Público 
            ['is_featured', '1'], # Destacado
        ])->paginate(3);

        # Para ver las vistas de esto debemos ir home.blade.php (línea 18)
        # Hay dos formas de enviar toda esta información a la vista: 

        # La primera forma es con ->with() 
        # return view('home')->with('articles', $articles);  
        # return view('home')->with('navbar', $navbar); 

        # La segunda es forma es con ->compact() 
        return view('home.index', compact('articles', 'navbar'));
    
}

    # Todas las categorías 
    function all(){
        $categories = Category::where('status', '1')
            ->simplePaginate(20); 

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1'],
        ])->paginate(3);

        return view('home.all-categories', compact('categories', 'navbar'));

    }
}

