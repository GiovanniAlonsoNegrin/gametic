@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Crear post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('slug', null, ['id' => 'slug', 'readonly']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'categoría') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <p class="font-weight-bold">Etiquetas</p>

                    @foreach ($tags as $tag)
                        <label class="mr-2">
                            {!! Form::checkbox('tags[]', $tag->id, null) !!}
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>

                <div class="form-group">
                    {!! Form::label('extract', 'Extracto') !!}
                    <div style="color:black !important">
                        {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group text-dark">
                    {!! Form::label('body', 'Curpo del post') !!}
                    <div style="color:black !important">
                        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                {!! Form::submit('Crear post', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });

        ClassicEditor
        .create( document.querySelector('#extract'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                ],
                shouldNotGroupWhenFull: true
            },
        } )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector('#body'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                ],
                shouldNotGroupWhenFull: true
            },
        } )
        .catch( error => {
            console.error( error );
        } );
    </script>
@stop