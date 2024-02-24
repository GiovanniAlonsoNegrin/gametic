@extends('adminlte::page')

@section('title', 'Gametic')

@section('content_header')
    @can('admin.tags.create')
        <a href="{{ route('admin.tags.create') }}" class="btn btn-success float-right">Añadir tag</a>
    @endcan
    <h1>Etiquetas</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success d-flex justify-content-between">
            <strong>{{ session('success') }}</strong><span id="closeAlert" class="font-weight-bold" style="cursor:pointer;color:black;">&#x2715;</span>
        </div>
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
                    @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td width="10px">
                                @can('admin.tags.edit')
                                    <a href="{{ route('admin.tags.edit', $tag) }}" class="fas fa-edit fa-1x"></a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.tags.delete')
                                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
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