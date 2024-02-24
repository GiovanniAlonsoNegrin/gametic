<div class="card">
    <div class="card-header">
        <div class="input-group mb-2">
            <input wire:model.live.debounce.500ms="search" class="form-control" placeholder="Ingrese el nombre de un usuario o un email de usuario">
        </div>
    </div>
    @if ($users->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Verificado</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->email_verified_at ? 'Si' : 'No' }}</td>
                            <td width="10px">
                                <a href="{{ route('admin.users.edit', $user) }}" class="fas fa-eye ml-3"></a>
                            </td>
                            <td width="10px">
                                @if ($authUser->id != $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="fas fa-trash-alt fa-1x text-danger ml-2 border-0 bg-transparent" type="submit" value="">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún registro que contenga estos criterios de búsqueda</strong>
        </div>
    @endif
</div>
