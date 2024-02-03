@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    <h1>Gametic</h1>
@stop

@section('content')
    <div class="container mx-auto">
        <h1 class="text-center font-bold display-1 mt-5 mb-5">
            @yield('code')
        </div>
        <div class="text-center display-4 mt-5">
            @yield('message')
        </div>
    </div>
@stop