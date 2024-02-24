@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    {{-- @can('admin.roles.create') --}}
        <a class="btn btn btn-success float-right" href="{{ route('admin.roles.create') }}">Nuevo Rol</a>
    {{-- @endcan --}}
    <h1>Lista roles</h1>
@stop

@section('content')
    @if (session('success'))
        @include('admin.partials.alert')
    @endif
    @livewire('admin.roles-index')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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