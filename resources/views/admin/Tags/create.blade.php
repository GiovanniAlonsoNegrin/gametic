@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Crear etiqueta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tags.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la etiqueta']) !!}

                    @error('name')
                        <small class="text-danger">* {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::hidden('slug', null, ['id' => 'slug', 'readonly']) !!}
                </div>

                @error('slug')
                    <small class="text-danger">* {{ $message }}</small>
                @enderror

                {{-- <div class="form-group">
                    <label for="color">Color:</label>
                    <select name="color" id="color" class="form-control">
                        <option value="red" selected>Rojo</option>
                        <option value="green">Verde</option>
                        <option value="blue">Azul</option>
                    </select>
                </div> --}}

                <div class="form-group">
                    {!! Form::label('color', 'Color') !!}
                    {!! Form::select('color', $colors, null, ['class' => 'form-control']) !!}

                    @error('color')
                        <small class="text-danger">* {{ $message }}</small>
                    @enderror
                </div>

                {!! Form::submit('Crear etiqueta', ['class' => 'btn btn-primary mt-3']) !!}
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