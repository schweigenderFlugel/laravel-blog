<!-- Extendemos el adminlte::page. Esto se encuentra en vendor/adminlte/page.blade.php -->
@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Bienvenidos al panel de administración</h1>
@endsection

@section('content')
    <p>¡Hola! {{ Auth::user()->full_name}}, desde aquí podrás administrar tus artículos, categorías y comentarios</p>


    @isset($keyword)

        @if($users != null)
        
        <h4>Total de resultados: {{ $resultados }}</h4>
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


            @else
                <p>No se ha encontrado registros con "{{ $keyword }}" en "{{ $searchBy }}"</p>
            @endif
    @endisset

@endsection 


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>
@endsection