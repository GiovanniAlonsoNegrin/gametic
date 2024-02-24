<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<h2 class="h3">Lista de permisos</h2>
<div class="my-3">
    <label for="permissions">Permisos</label>
    <select id="permissions" name="permissions[]" multiple style="width: 100%;">
        @foreach ($permissions as $permission)
            @isset($role)
                <option value="{{ $permission->id }}" @if($role->hasPermissionTo($permission->name)) selected @endif>
            @else
                <option value="{{ $permission->id }}">
            @endisset
                {{ $permission->description }}
            </option>
        @endforeach
    </select>
</div>

@error('permissions')
    <small class="text-danger">{{ $message }}</small>
    <br>
@enderror
