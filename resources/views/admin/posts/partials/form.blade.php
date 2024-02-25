<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post', 'readonly' => isset($post) && ($post->user->id != auth()->user()->id)]) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::hidden('slug', null, ['id' => 'slug', 'readonly']) !!}
    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('category_id', 'categoría') !!}
    @isset($post)
        @if ($post->user->id == auth()->user()->id)
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        @else
            {!! Form::hidden('category_id', $post->category->id, ['id' => 'category_id', 'readonly']) !!}
            <div class="border border-secondary rounded p-1 pl-2">
                {{ $post->category->name }}
            </div>
        @endif
    @else
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @endisset

    @error('category')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="my-3">
    <label for="tags">Etiquetas</label>
    <select id="tags" name="tags[]" multiple style="width: 100%;">
        @foreach ($tags as $tag)
            @isset ($post)
                <option value="{{ $tag->id }}" @if($post && $post->tags->contains('id', $tag->id)) selected @endif>
            @else
                <option value="{{ $tag->id }}">
            @endisset
                {{ $tag->name }}
            </option>
        @endforeach
    </select>

    @error('tags')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="default">
            @else
                <img id="picture" src="https://img.freepik.com/foto-gratis/hombre-traje-neon-sienta-silla-letrero-neon-que-dice-palabra-el_188544-27011.jpg?t=st=1708710699~exp=1708714299~hmac=01854f13b6c10db9a0587ab35bd9e99a5d91f4cbb2560a72b0e652b4370ff2ba&w=2000" alt="default">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen del post') !!}
            @isset ($post)
                @if ($post->user->id == auth()->user()->id)
                    {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
                @endif
            @else
                {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
            @endisset
        </div>

        @error('file')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

<div class="form-group">
    {!! Form::label('extract', 'Extracto') !!}
    <div style="color:black !important">
        {!! Form::textarea('extract', null, ['class' => 'form-control', 'readonly' => isset($post) && ($post->user->id != auth()->user()->id)]) !!}
    </div>

    @error('extract')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group text-dark">
    {!! Form::label('body', 'Cuerpo del post') !!}
    <div style="color:black !important">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'readonly' => isset($post) && $post->user->id != auth()->user()->id]) !!}
    </div>

    @error('body')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>