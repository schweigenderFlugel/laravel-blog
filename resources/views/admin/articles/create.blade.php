@extends('adminlte::page')

@section('title', 'Crear artículo')

@section('content_header')
    <h2>Crear Nuevo Artículo</h2>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Título</label>
                <input type="text" class="form-control" id="title" name='title'
                    placeholder="Ingrese el nombre del artículo" minlength="5" maxlength="255" 
                    value="{{ old('title') }}">

                @error('title')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" class="form-control" id="slug" name='slug' 
                    placeholder="Slug del artículo" readonly value="{{ old('slug') }}">

                @error('slug')
                <span class="text-danger">
                    <span>* {{ $message}}</span>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <label>Introducción</label>
                <input type="text" class="form-control" id="introduction" name='introduction'
                    placeholder="Ingrese la introducción del artículo" minlength="5" maxlength="255"
                    value="{{ old('introduction')}}">

                @error('title')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <label for="">Subir imagen</label>
                <input type="file" class="form-control-file" id="image" name='image'>

                @error('image')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group w-5">
                <label for="">Desarrollo del artículo</label>
                <!-- Colocamos el ckeditor en la class para tomar los estilos de este editor  --> 
                <textarea class="ckeditor form-control" id="body" name="body">{{ old('body') }} </textarea>

                @error('body')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                
            </div>

            <label for="">Estado</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Privado</label>
                    <input class="form-check-input ml-2" type="radio" name='status' 
                    id="status" value="0" checked>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Público</label>
                    <input class="form-check-input ml-2" type="radio" name='status' 
                    id="status" value="1">
                </div>

                @error('status')
                <span class="text-danger">
                    <span>* {{ $message}}</span>
                </span>
                @enderror
            
            </div>

            <div class="form-group">
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Seleccione una categoría</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >
                        {{ $category->name }}
                    </option>
                    @endforeach
                    
                </select>

                @error('category_id')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                
            </div>

            <input type="submit" value="Agregar artículo" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection

@section('js')

    <!-- Hay que insertar el script de ckeditor --> 
    <script src=""></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error=> {
                console.error(error); 
            }); 
    </script>

    <!-- Debemos alojar la librería de Jquery en la carpeta public/vendor/jquery -->
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#title').stringToSlug({
                setEvents: 'keyup keydown blur', 
                getPut: '#slug', 
                space: '-'
            });
        });
    </script>

@endsection