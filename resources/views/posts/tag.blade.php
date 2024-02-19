<x-base-layout>
    <div class="container py-8">
        <h1 class="uppercase text-center text-4xl font-bold text-white mb-5">Etiqueta: {{ $tag->name }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="col-span-2">
                @forelse ($posts as $post)
                    <x-card-post :post="$post" />
                @empty
                @endforelse

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
            <div>
                <h1 class="uppercase text-center text-3xl text-white font-bold mb-4 bg-blue-950 py-4">Últimas publicaciones</h1>
                @forelse ($latestPosts as $latestPost)
                    <article class="mb-4 shadow-lg flex">
                        <img class="w-30 h-20 object-cover object-center" src="{{ Storage::url($latestPost->image->url) }}" alt="{{ $latestPost->name }}">

                        <div class="ml-2">
                            <h1 class="font-bold text-xl mb-2 text-white">
                                <a href="{{ route('posts.show', $latestPost) }}">{{ $latestPost->name }}</a>
                            </h1>
                        </div>
                    </article>
                @empty
                    <article>
                        <p>No existen posts</p>
                    </article>
                @endforelse

                <h1 class="uppercase text-center text-3xl text-white font-bold bg-blue-950 py-4">Otras categorías</h1>
                @forelse ($categories as $category)
                    <a href="{{ route('posts.category', $category) }}">
                        <div class="bg-sky-500 my-4 w-6/12 rounded-full py-1 flex justify-center items-center mx-auto group hover:bg-gray-100">
                            <span class="text-bold capitalize text-white text-3xl transition-colors duration-300 group-hover:text-blue-400">{{ $category->name }}</span>
                        </div>
                    </a>
                @empty
                @endforelse

                <h1 class="uppercase text-center text-3xl text-white font-bold bg-blue-950 py-4">Etiquetas</h1>
                @forelse ($tags as $tag)
                    <a href="{{ route('posts.tag', $tag) }}">
                        <div class="bg-{{ $tag->color }}-600 my-4 w-6/12 rounded-full py-1 flex justify-center items-center mx-auto group hover:bg-gray-100">
                            <span class="text-bold capitalize text-white text-3xl transition-colors duration-300 group-hover:text-sky-600">{{ $tag->name }}</span>
                        </div>
                    </a>
                @empty
                @endforelse
            </aside>
        </div>
    </div>
</x-base-layout>