<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;
use App\Models\Article;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    # Para proteger las rutas
    public function __construct(){

        $this->middleware('can:categories.index')->only('index'); 
        $this->middleware('can:categories.create')->only('create', 'store'); 
        $this->middleware('can:categories.edit')->only('edit', 'update'); 
        $this->middleware('can:categories.destroy')->only('destroy'); 

    }
    

    public function index()
    {
        //Mostrar las catgorías en el administrador
        $categories = Category::orderBy('id', 'desc')
                        ->simplePaginate(8); 

        return view('admin.categories.index', compact('categories')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all(); 

        # Validar si hay un archivo
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories'); 
        }

        # Guardar información 
        Category::create($category); 

        return redirect()->action([CategoryController::class, 'index'])
                ->with('success-create', 'Categoría cread con éxito'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if($request->hasFile('image')){
            File::delete(public_path('storage/'. $category->image)); 
            $category['image'] = $request->file('image')->store('categories'); 
        }

        $category->update([
            'name' => $request->name, 
            'slug' => $request->slug, 
            'status' => $request->status, 
            'is_featured' => $request->is_featured, 
        ]); 

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                ->with('success-update', 'Categoría modificada con éxito'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->image){
            File::delete(public_path('storage/' . $category->image)); 
        }

        $category->delete(); 

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
                ->with('success-delete', 'Categoría eliminada con éxito'); 
    }

    # Filtrar artículos por categorías. Este método no viene incluido en Laravel
    public function detail(Category $category){

        $this->authorize('published', $category); 

        $articles = Article::where([
            ['category_id', $category->id], 
            ['status', '1']
        ])

            ->orderBy('id', 'desc')
            ->simplePaginate(5); 

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1'],
        ])->paginate(3);

        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar')); 

    }

}
