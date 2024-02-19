<div class="card">
    <div class="card-header">
        <div class="input-group mb-2">
            <input wire:model.live.debounce.500ms="search" class="form-control" placeholder="Ingrese el nombre de un post o un email de usuario">
        </div>
    </div>
    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email usuario</th>
                        <th>Nombre usuario</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td>{{ $post->User->email }}</td>
                            <td>{{ $post->User->name }}</td>
                            <td width="10px">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="fas fa-edit fa-1x"></a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="fas fa-trash-alt fa-1x text-danger ml-2 border-0 bg-transparent" type="submit" value="">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún registro que contenga estos criterios de búsqueda</strong>
        </div>
    @endif
</div>
