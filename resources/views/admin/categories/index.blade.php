@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    @can('admin.categories.create')
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success float-right">Añadir categoría</a>
    @endcan
    <h1>Categorías</h1>
@stop

@section('content')
    @if (session('success'))
        @include('admin.partials.alert')
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                                @can('admin.categories.edit')
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="fas fa-edit fa-1x"></a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.categories.delete')
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="fas fa-trash-alt fa-1x text-danger ml-2 border-0 bg-transparent" type="submit" value="">
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
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
