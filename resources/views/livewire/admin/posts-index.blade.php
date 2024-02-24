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
                        <th>Estado</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td>{{ $post->user->email }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                @can('admin.posts.status')
                                    <div class="custom-control custom-switch">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input my-pointer"
                                            id="{{$post->id}}"
                                            style="cursor:pointer;"
                                            wire:model="state.switchStatus.{{$post->id}}"
                                            wire:click="toggleSwitch({{$post->id}})"
                                            @if($switchStatus[$post->id] == 'enable') checked @endif>
                                        <label class="custom-control-label" for="{{$post->id}}" style="cursor:pointer;"></label>
                                    </div>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.posts.edit')
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="{{$post->user->id == auth()->user()->id ? 'fas fa-edit fa-1x': 'fas fa-eye'}}"></a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.posts.delete')
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="fas fa-trash-alt fa-1x text-danger ml-2 border-0 bg-transparent" type="submit" value="">
                                    </form>
                                @endcan
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
