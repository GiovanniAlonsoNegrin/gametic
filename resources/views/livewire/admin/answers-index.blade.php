<div>
    <h3>Respuestas</h1>
    <div class="card">
        <div class="card-header">
            <div class="input-group mb-2">
                <input wire:model.live.debounce.500ms="search" class="form-control" placeholder="Ingrese el contenido de una pregunta o el nombre de un usuario o un email de usuario">
            </div>
        </div>
        @if ($answers->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Contenido</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th colspan="">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $answer)
                            <tr>
                                <td>{{ $answer->id }}</td>
                                <td>{{ $answer->body }}</td>
                                <td>{{ $answer->user->name }}</td>
                                <td>{{ $answer->user->email }}</td>
                                <td width="10px">
                                    {{-- @can('admin.comments.delete') --}}
                                        <button wire:click="$dispatch('deleteAnswer', {{ $answer->id }})" class="fas fa-trash-alt fa-1x text-danger ml-2 border-0 bg-transparent" type="button">
                                    {{-- @endcan --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $answers->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay ningún registro que contenga estos criterios de búsqueda</strong>
            </div>
        @endif
    </div>
</div>


