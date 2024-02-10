<header class="header">
    <div class="menu">

        <div class="logo">
            <!--Logo-->
            <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>

        @guest <!-- Si el usuario no está autenticado. Este guest es un middleware que se encuentra 
                alojado en la carpeta Auth  -->
        <ul class="d-flex">
            <li><a href="{{ route('login') }}" class="login">Acceder</a></li>
            <li><a href="{{ route('register') }}" class="create">Crear cuenta</a></li>
        </ul>

        @else <!-- En caso contrario -->
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
               data-bs-toggle="dropdown" aria-expanded="false">

                <img src="{{ Auth::user()->profile->photo ? asset('storage/' . Auth::user()->profile->photo)
                    : asset('img/user-default.png') }}" alt="Profile" class="img-profile">
          
                <span class="name-user">{{ Auth::user()->full_name }}</span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item"
                        href="{{ route('profiles.show', ['profile' => Auth::user()->id ]) }}">Perfil</a></li>
                
                <!--  La directiva can es para comprobar si el usuario auténticado tiene el rol de administrador-->
                @can('admin.index')
                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Ir al admin</a></li>
                @endcan
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                    @csrf 
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                           document.getElementById('logout-form').submit();">Salir</a>
                </li>
            </ul>
        </div>
        @endguest
        </nav>
    </div>

</header>