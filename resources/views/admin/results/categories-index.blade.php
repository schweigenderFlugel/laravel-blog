@extends('adminlte::page')

@section('title', 'Resultados de búsqueda')

@section('content')

    @isset($keyword)

        @if($results > 0)
        <div class="alert alert-success">
            Total de resultados: {{ $results }}
        </div>

        <div class="card">
            <div class="card-body">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Destacado</th>
                </tr>
            </thead>

            <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <input type="checkbox" name="status" id="status" class="form-check-input ml-3"
                    {{ $category->status ? 'checked="checked"' : '' }} disabled>
                </td>
                <td>
                    <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input ml-4"
                    {{ $category->is_featured ? 'checked="checked"' : '' }} disabled>
                </td>

                @can('categories.edit')
                <td width="10px"><a href="{{ route('categories.edit', $category->slug ) }}"
                        class="btn btn-primary btn-sm mb-2">Editar</a></td>
                @endcan

                @can('categories.destroy')
                <td width="10px">
                    <form action="{{ route('categories.destroy', $category->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                    </form>
                </td>
                @endcan

            </tr>
            @endforeach
            </tbody>
            </table>
            </div>
        </div>

        @else
        <div class="alert alert-info">
            No se ha encontrado registros con la palabra <em>"{{ $keyword }}"</em> en <em>"Categorías"</em>
        </div>
        @endif

    @endisset

@endsection