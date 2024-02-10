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

        @else
        <div class="alert alert-info">
            No se ha encontrado registros con <em>"{{ $keyword }}"</em> en <em>"Usuarios"</em>
        </div>
        @endif

    @endisset

@endsection


