@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['admin.tags.update', $tag], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}

                    @error('name')
                        <span class="text-danger">* {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::hidden('slug', $tag->slug, ['id' => 'slug', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('color', 'Color') !!}
                    {!! Form::select('color', $colors, $tag->color, ['class' => 'form-control']) !!}

                    @error('color')
                        <small class="text-danger">* {{ $message }}</small>
                    @enderror
                </div>
                {!! Form::submit('Actualizar categoría', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@stop