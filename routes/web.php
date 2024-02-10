<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Esto lo trae Laravel por defecto 
Route::get('/', function () {
return view('welcome');
});*/ 



Route::get('/', [HomeController::class, 'index'])->name('home.index');

# Esta ruta llama la función all en el HomeController (véase línea 51)
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

# Ruta para verificar datos de acceso al panel de administración
Route::get('/admin/auth', [AdminController::class, 'adminAccess'])
                    ->middleware('can:admin.index') 
                    ->name('admin.login'); 

# Ruta del administrador
Route::get('/admin', [AdminController::class, 'index'])
                    /* Esta directiva middleware protege las URLs de aquellos usuarios que no son 
                    administradores. Véase los controladores de articulos, categorías, comentarios,
                    usuarios y perfiles para ver como están protegidos. */
                    ->middleware('can:admin.index') 
                    ->name('admin.index'); 

# Con el namespace especificamos el directorio de los controladores. El prefijo 'admin' va tomar 
# todos los redireccionamientos de los controladores cuyo prefijo es admin y finalmente los agrupamos. 
Route::namespace('App\Http\Controllers')->prefix('admin')->group(function(){

    # Artículos 
    # El primer parámetro es el recurso de la vista y el segundo es el nombre de la clase
    Route::resource('articles', 'ArticleController')
        # except significa que estamos evitando el método show de la clase ArticleController
        ->except('show')
        # y finalmente le vamos a dar nombre a la ruta, el cual va a ser usado en las vistas.
        ->names('articles'); 


         # Sólo recordar es especificar el método. Por ej. si queremos llamar la plantilla de editar 
        # un artículo debemos escribir {{ route('articles.edit') }} en el href correspondiente

    /* Para descargar Artículo. Hay que recordar que estaremos pasando el slug en las vistas, por lo 
    tanto debemos escribir {article}*/
    Route::get('articles/{article}', [ArticleController::class, 'viewPDF'])->name('article.pdf'); 


    # Categorías
    Route::resource('categories', 'CategoryController')
        ->except('show')
        ->names('categories'); 

    # Comentarios
    Route::resource('comments', 'CommentController')
        ->only('index', 'destroy')
        ->names('comments'); 

    # Usuario
    Route::resource('users', 'UserController')
        ->except('create', 'store', 'show')
        ->names('users'); 

    # Roles
    Route::resource('roles', 'RoleController')
            ->except('show')
            ->names('roles'); 

    
    Route::resource('results', 'SearchController');

});



# Ruta de los perfiles
Route::resource('profiles', ProfileController::class)
                ->only('edit', 'update', 'show')
                ->names('profiles'); 

# Para ver los artículos
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show'); 

# Para ver los artículos por categoría
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail'); 

# Para guardar los comentarios
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store'); 

# Para iniciar búsqueda
Route::match(['get'], '/navbar/search', [SearchController::class, 'search']); 

# Ruta de los métodos de la clase del controlador del artículo 
/* Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

# article va entre llaves porque hay un slug 
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');*/

# Hay una mejor opción para optimizar todas estas rutas. Para ello escribimos en la terminal: 
# php artisan route:list para listar todas las rutas actuales

Auth::routes();

