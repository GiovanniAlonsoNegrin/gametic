<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<h2 class="h3">Lista de permisos</h2>
@forelse ($permissions as $permission)
    <div>
        <label for="permissions">
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
            {{ $permission->description }}
        </label>
    </div>
@empty
    <div>
        <p>No hay permisos disponibles</p>
    </div>
@endforelse
@error('permissions')
    <small class="text-danger">{{ $message }}</small>
    <br>
@enderror
