<div class="card">
    <div class="card-header">
        <div class="input-group mb-2">
            <input wire:model.live.debounce.500ms="search" class="form-control" placeholder="Ingrese el nombre de un post o un email de usuario">
        </div>
    </div>
    @if ($roles->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td width="10px">
                                {{-- @can('admin.roles.edit') --}}
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="fas fa-edit fa-1x"></a>
                                {{-- @endcan --}}
                            </td>
                            <td width="10px">
                                {{-- @can('admin.roles.delete') --}}
                                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="fas fa-trash-alt fa-1x text-danger ml-2 border-0 bg-transparent" type="submit" value="">
                                    </form>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $roles->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún registro que contenga estos criterios de búsqueda</strong>
        </div>
    @endif
</div>
