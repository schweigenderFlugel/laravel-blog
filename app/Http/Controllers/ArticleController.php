<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    # Para proteger las rutas
    public function __construct(){

        $this->middleware('can:articles.index')->only('index'); 
        $this->middleware('can:articles.create')->only('create', 'store'); 
        $this->middleware('can:articles.edit')->only('edit', 'update'); 
        $this->middleware('can:articles.destroy')->only('destroy'); 

    }
    

    public function index()
    {
        # Para mostrar los artículos en el administrador
        $user = Auth::user();
        # La condición es mostrar los artículos del usuario que se encuentre auteticado 
        $articles = Article::where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->simplePaginate(10); 

        return view('admin.articles.index', compact('articles')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # Para obtener las categorías públicas
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get(); 
        
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    # Debemos crear las reglas de validación. Se pueden crear en el mismo controlador, 
    # pero es recomendable hacerlo en un archivo aparte, en un archivo request (ArticleRequest)
    public function store(ArticleRequest $request)
    {

        # El merge sirve para combinar los datos que vienen de la solicitud con los datos que el administrador quiere
        $request->merge([
            'user_id' => Auth::user()->id, 
        ]);

        # Para guardar la solicitud en una  variable 
        $article = $request->all(); 

        # Para validar si hay un archivo en el request
        if($request->hasFile(('image'))){
            $article['image'] = $request->file('image')->store('articles'); 
        }

        /* Esto es para comprobar si el artículo se ha creado exitosamente
        echo '<pre>'; 
        var_dump($article); 
        echo '</pre>'; 
        exit; 
        */

        Article::create($article); 

        # Esto es para redireccionarlo al index. Véase su ruta en web.php (línea 55)
        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-create', 'Articulo creado con éxito'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

        # Esto llama el método published en el archivo ArticlePolicy (línea 95)
        $this->authorize('published', $article); 

        # Recordar que el modelo Article tiene una relación de uno o varios con el modelo comentarios. 
        $comments = $article->comments()->simplePaginate(5); 

        return view('subscriber.articles.show', compact('article', 'comments')); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {

        # Esto llama al método view del ArticlePolicy
        $this->authorize('view', $article); 

        # Para obtener las categorías públicas
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get(); 
        
        return view('admin.articles.edit', compact('categories', 'article'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {

        # Esto llama al método update del ArticlePolicy
        $this->authorize('update', $article); 

        # Si el usuario sube una nueva imagen
        if($request->hasFile('image')){
            # Entonces se elimina la imagen anterior...
            File::delete(public_path('storage/'.$article->image));
            # ... y se asigna la nueva imagen
            $article['image'] = $request->file('image')->store('articles'); 
        }

        # Actuallizar datos 
        $article->update([
            'title' => $request->title,
            'slug' => $request->slug, 
            'introduction' => $request->introduction, 
            'body' => $request->body,
            'user_id' => Auth::user()->id, 
            'category_id' => $request->category_id, 
            'status' => $request->status,
        ]); 

        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-update', 'Articulo modificado con éxito'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        # Esto llama al método delete del ArticlePolicy
        $this->authorize('delete', $article); 

        # Eliminar la imagen del artículo
        if($article->image){
            File::delete(public_path('storage/' . $article->image)); 
        }

        # Eliminar artículo
        $article->delete();

        return redirect()->action([ArticleController::class, 'index'], compact('article'))
                            ->with('success-delete', 'Articulo eliminado con éxito'); 

    }

    public function viewPDF(Article $article){

        $pdf = Pdf::loadView('admin.articles.pdf', compact('article'))
                ->setPaper('a4', 'portrait'); 

        return $pdf->stream(); 

    }

}
