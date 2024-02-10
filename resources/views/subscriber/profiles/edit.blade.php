@extends('layouts.base')

@section('styles')
    <link href="{{ asset('css/user/profiles/css/style_profile.css') }}" rel="stylesheet">
@endsection

@section('title', 'Editar perfil')

@section('content')

<div class="btn-article">
    <a href="{{ route('home.index') }}" class="btn-new-article">⬅</a>
</div>

<div class="main-content">
    <div class="title-page-admin">
        <h2>Editar Perfil</h2>
    </div>
    <form method="POST" action="{{ route('profiles.update', $profile)}}" enctype="multipart/form-data"
        class="form-article">
        @csrf
        @method('PUT')
        <div class="content-create-article">

            <div class="input-content">
                <label for="name">Nombre completo:</label>
                <input type="text" name="full_name" placeholder="Escribe tu nombre completo"
                    value="{{ $profile->user->full_name }}" autofocus>

                @error('full_name')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="email">Correo eléctronico</label>
                <input type="text" name="email" placeholder="Correo eléctronico" value="{{ $profile->user->email }}"
                    autofocus>

                @error('email')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="profession">Profesión:</label>
                <input type="text" name="profession" placeholder="Escribe acerca de tu profesión"
                    value="{{ $profile->profession }}" autofocus>

                @error('profession')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="about">Sobre mí:</label>
                <input type="text" name="about" placeholder="Escribe información adicional"
                    value="{{ $profile->about }}" autofocus>

                @error('about')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="facebook">Facebook:</label>
                <input type="text" name="facebook" placeholder="Ingrese una url"
                    value="{{ $profile->facebook }}" autofocus>

                @error('facebook')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="twitter">Twitter:</label>
                <input type="text" name="twitter" placeholder="Ingrese una url"
                    value="{{ $profile->twitter }}" autofocus>

                @error('twitter')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="linkedin">Linkedin:</label>
                <input type="text" name="linkedin" placeholder="Ingrese una url"
                    value="{{ $profile->linkedin }}" autofocus>

                @error('linkedin')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="input-content">
                <label for="image">Foto de perfil</label> <br>
                <input type="file" id="photo" accept="image/*" name="photo" class="form-input-file">

                @if($profile->photo)
                <label>Foto actual</label>
                <div class="img-article">
                    <img src="{{ asset('storage/'. $profile->photo) }}" class="img">
                </div>

                @error('image')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                @endif
            </div>

            <input type="submit" value="Editar perfil" class="button">
    </form>
</div>
@endsection