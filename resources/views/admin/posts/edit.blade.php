@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Editar post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($post, ['route' => ['admin.posts.update', $post], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}
                @include('admin.posts.partials.form')

                @if ($post->user->id == auth()->user()->id)
                    {!! Form::submit('Actualizar post', ['class' => 'btn btn-primary']) !!}
                @else
                    {!! Form::submit($post->status == 'enable' ? 'Deshabilitar post' : 'Habilitar post', ['class' => 'btn btn-primary']) !!}
                @endif
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
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

        @if ($post->user->id == auth()->user()->id)
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
        @endif

        const file = document.getElementById("file")
        if (file) {
            file.addEventListener('change', cambiarImagen);
            function cambiarImagen(event){
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload= (event)=>{
                    document.getElementById("picture").setAttribute('src', event.target.result)
                };
                reader.readAsDataURL(file);
            }
        }

    </script>
@stop