@extends('adminlte::page')

@section('title', 'Resultados de búsqueda')

@section('content')

    @isset($keyword)

        @if($totalResults > 0)
        <div class="alert alert-success">
            Total de resultados: {{ $totalResults }}
        </div>

            @if($userResults > 0)
            <h5>Usuarios: {{ $userResults }}</h5>
            <div class="card">
                <div class="card-body">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>

                    <td width="10px"><a href="{{ route('users.edit', $user ) }}"
                        class="btn btn-primary btn-sm mb-2">Editar</a>
                    </td>

                    <td width="10px">
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
                </table>
                </div>
            </div>
            @endif

            @if($categoriesResults > 0)
            <h5>Categorías: {{ $categoriesResults }}</h5>
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
            @endif

        @else
        <div class="alert alert-info">
            No se ha encontrado registros
        </div>
        @endif

    @endisset

@endsection


