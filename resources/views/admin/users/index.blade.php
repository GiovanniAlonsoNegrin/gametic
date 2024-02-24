@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Lista usuarios</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success d-flex justify-content-between">
            <strong>{{ session('success') }}</strong><span id="closeAlert" class="font-weight-bold" style="cursor:pointer;color:black;">&#x2715;</span>
        </div>
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