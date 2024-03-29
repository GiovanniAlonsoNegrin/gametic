@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    @can('admin.posts.create')
        <a class="btn btn btn-success float-right" href="{{ route('admin.posts.create') }}">Nuevo post</a>
    @endcan
    <h1>Posts</h1>
@stop

@section('content')
    @if (session('success'))
        @include('admin.partials.alert')
    @endif
    @livewire('admin.posts-index')
@stop

@section('js')
    <script>
        const alert = document.querySelector('.alert.alert-success');
        const closeAlert = document.querySelector('#closeAlert');
        if (alert) {
            closeAlert.addEventListener("click", function() {
                alert.style.setProperty('display', 'none', 'important');
            });
        }
    </script>
@stop