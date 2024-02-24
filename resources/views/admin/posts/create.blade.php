@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Crear post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}
                @include('admin.posts.partials.form')
                {!! Form::submit('Crear post', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
        integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
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
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>

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

        document.getElementById("file").addEventListener('change', cambiarImagen);
        function cambiarImagen(event){
            let file = event.target.files[0];
            let reader = new FileReader();
            reader.onload= (event)=>{
                document.getElementById("picture").setAttribute('src', event.target.result)
            };
            reader.readAsDataURL(file);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#tags').selectize({
                maxItems: null,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
            })
        });
    </script>
@stop