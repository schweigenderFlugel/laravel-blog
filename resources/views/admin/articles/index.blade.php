<!-- Ver en el archivo adminlte, línea 323 --> 
@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h2>Administra tus artículos</h2>
@endsection 

@section('content')

<!-- Esto es para recibir el mensaje de artículos creado con éxito desde el 
controlador mediante el método store, update y delete -->
@if(session('success-create'))
<div class="alert alert-info">
    {{ session('success-create') }}
</div>
@elseif(session('success-update'))
<div class="alert alert-info">
    {{ session('success-update') }}
</div>
@elseif(session('success-delete'))
<div class="alert alert-info">
    {{ session('success-delete') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{ route('articles.create') }}">Crear artículo</a>
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ Str::limit($article->title, 25, '...') }}</td>
                    <!--  El operador ?? significa que es devolver un valor que no sea nulo, en caso 
                    que el primero sea nulo. Sin esto, se dispara el siguiente mensaje de error: 
                    "Attempt to read property "name" on null". Porque los artículos no tienen una
                    categorías asignada --> 
                    <td>{{ $article->category->name ?? '' }}</td>
                    <td>
                        <input type="checkbox" name="status" id="status" class="form-check-input ml-4"
                        {{ $article->status ? 'checked="checked"' : '' }}
                        disabled>
                    </td>

                    <td width="2px"><a href="{{ route('articles.show', $article->slug)}}"
                            class="btn btn-primary btn-sm mb-2">Mostrar</a></td>

                    <td width="5px"><a href="{{ route('articles.edit', $article->slug) }}"
                            class="btn btn-primary btn-sm mb-2">Editar</a></td>

                    <td width="5px">
                        <form action="{{ route('articles.destroy', $article->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                        </form>
                    </td>

                    <td width="5px"><a href="{{ route('article.pdf',  $article->slug) }}"
                        class="btn btn-outline-danger btn-sm mb-3" target="_blank">
                        <i class="far fa-file-pdf"></i></a>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="text-center mt-3">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection