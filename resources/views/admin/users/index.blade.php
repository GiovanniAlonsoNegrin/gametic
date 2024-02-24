@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Lista usuarios</h1>
@stop

@section('content')
    @if (session('success'))
        @include('admin.partials.alert')
    @endif
    @livewire('admin.users-index')
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