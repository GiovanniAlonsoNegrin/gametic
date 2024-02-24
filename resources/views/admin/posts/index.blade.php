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
        <div class="alert alert-success d-flex justify-content-between">
            <strong>{{ session('success') }}</strong><span id="closeAlert" class="font-weight-bold" style="cursor:pointer;color:black;">&#x2715;</span>
        </div>
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