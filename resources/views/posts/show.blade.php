<x-base-layout>
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-white">{{ $post->name }}</h1>
        <div class="text-lg text-white mb-2">
            {{ $post->extract }}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- * Main content --}}
            <div class="lg:col-span-2">
                <figure>
                    <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="{{ $post->name }}">
                </figure>
                <div class="text-base text-white mt-4 text-justify">
                    {{ $post->body }}
                </div>
            </div>

            {{-- * Related content --}}
            <aside>
                <h1 class="text-2xl font-bold text-white mb-4">Más en {{ $post->category->name }}</h1>
                <ul>
                    @forelse ($relatedPosts as $relatedPost)
                        <li class="mb-4">
                            <a class="flex" href="{{ route('posts.show', $relatedPost) }}">
                                <img class="w-30 h-20 object-cover object-center" src="{{ Storage::url($relatedPost->image->url) }}" alt="{{ $relatedPost->name }}">
                                <span class="ml-2 text-white">{{ $relatedPost->name }}</span>
                            </a>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </aside>
        </div>
    </div>
</x-base-layout>