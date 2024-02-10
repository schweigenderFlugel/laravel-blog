<div class="category-container">
    <ul>
        <!-- Este request es para iluminar la pestaña en la que el usuario se encuentra -->
        <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }} ">
            <a href="{{ route('home.index') }}">Todo</a></li>         
        
        <!-- Este foreach lista el navbar como categorías. Esto está en el HomeController (línea 38)  --> 
        @foreach($navbar as $category)
        <!-- Escapar datos (!!) significa que el usuario no podrá modificar los datos desde el frontend 
        este código. Sirve para ataques XSS --> 
        <li class="nav-item {!! (Request::path()) == 'category/'. $category->slug ? 'active' : '' !!} ">
            <a href="{{ route('categories.detail', $category->slug) }}">{{ $category->name }}</a>
        </li>
        @endforeach

        <li class="nav-item {{ request()->routeIs('home.all') ? 'active' : '' }}">
            <a href="{{ route('home.all') }}">Todas las categorias</a>
        </li>

    </ul>
</div>