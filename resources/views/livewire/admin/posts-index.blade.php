<div class="card">
    <div class="card-header">
        <form wire:submit="save">
            {{-- * wire:model.live --}}
            <div class="input-group mb-2">
                <input wire:model="postName" class="form-control" placeholder="Ingrese el nombre de un post">
            </div>
            <div class="input-group mb-2">
                <input wire:model="postUser" type="email" class="form-control" placeholder="Ingrese el email de un usuario">
            </div>
            @error('postUser') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="d-flex justify-content-between mt-2">
                <button type="submit" class="btn btn-primary">
                    <span wire:loading class="spinner-grow spinner-grow-sm"></span>
                    <span wire:loading>Cargando</span>
                    <span wire:loading.remove>buscar</span>
                </button>
                <button wire:click="showMyPosts" class="btn btn-success">
                    <span wire:loading class="spinner-grow spinner-grow-sm"></span>
                    <span wire:loading>Cargando</span>
                    <span wire:loading.remove>Ver mis posts</span>
                </button>
                <button wire:click="resetPosts" class="btn btn-secondary">
                    <span wire:loading class="spinner-grow spinner-grow-sm"></span>
                    <span wire:loading>Cargando</span>
                    <span wire:loading.remove>Ver todo</span>
                </button>
            </div>
        </form>
    </div>
    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td>{{ $post->user->email }}</td>
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
