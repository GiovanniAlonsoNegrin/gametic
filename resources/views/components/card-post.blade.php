@props(['post'])
<a href="{{ route('posts.show', $post) }}">
    <article class="mb-8 bg-white dark:bg-gray-800 shadow-lg">
        <img class="w-full h-56 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="{{ $post->name }}">

        <div class="px-6 pt-4">
            @forelse ($post->tags as $tag)
                <a href="{{ route('posts.tag', $tag) }}" class="inline-block bg-{{ $tag->color }}-600 rounded-full px-3 py-1 text-sm text-white mr-2">{{ $tag->name }}</a>
            @empty
            @endforelse
        </div>

        <div class="px-6 pt-2 pb-6">
            <h1 class="font-bold text-xl mb-2 dark:text-white">
                <p>{{ $post->name}}</p>
            </h1>

            <div class="text-gray-700 dark:text-white text-base">
                {!! $post->extract !!}
            </div>
        </div>
    </article>
</a>