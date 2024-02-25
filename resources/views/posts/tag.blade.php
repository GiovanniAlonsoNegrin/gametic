<x-base-layout>
    <div class="container py-8">
        <h1 class="uppercase text-center text-4xl font-bold dark:text-white mb-5">Etiqueta: {{ $tag->name }}</h1>
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
                    <a href="{{ route('posts.show', $latestPost) }}">
                        <article class="mb-4 bg-white dark:bg-gray-800 shadow-lg flex">
                            <img class="w-30 h-20 object-cover object-center" src="{{ Storage::url($latestPost->image->url) }}" alt="{{ $latestPost->name }}">

                            <div class="ml-2 pr-1">
                                <h1 class="font-bold text-base dark:text-white mb-2">
                                    {{ $latestPost->name }}
                                </h1>
                            </div>
                        </article>
                    </a>
                @empty
                    <article>
                        <p>No existen posts</p>
                    </article>
                @endforelse

                <h1 class="uppercase text-center text-3xl text-white font-bold bg-blue-950 py-4">Otras categorías</h1>
                <div class="bg-white dark:bg-gray-800 shadow-lg py-5">
                    @forelse ($categories as $category)
                        <a href="{{ route('posts.category', $category) }}">
                            <div class="my-4 w-6/12 rounded-full py-1 flex flex-col justify-center items-center mx-auto group transition-all">
                                <span class="dark:text-white text-bold capitalize text-3xl transition-colors duration-300 group-hover:text-blue-400">{{ $category->name }}</span>
                                {{-- <div class="w-3/4 h-1 transition transform duration-300 ease-in-out delay-150 group-hover:bg-blue-500 group-hover:shadow-lg group-hover:shadow-blue-500/50 width group-hover:scale-110 rounded-full"></div> --}}
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>

                <h1 class="uppercase text-center text-3xl text-white font-bold mt-4 bg-blue-950 py-4">Etiquetas</h1>
                <div class="bg-white dark:bg-gray-800 shadow-lg py-5">
                    @forelse ($tags as $tag)
                        <a href="{{ route('posts.tag', $tag) }}">
                            <div class="my-4 rounded-full py-1 flex flex-col justify-center items-center mx-auto group transition-all">
                                <span class="dark:text-white text-bold capitalize text-3xl transition-colors duration-300 group-hover:text-{{$tag->color}}-400">{{ $tag->name }}</span>
                                {{-- <div class="w-3/4 flex-end h-1 transition transform duration-300 ease-in-out delay-150 group-hover:bg-{{ $tag->color }}-600 group-hover:shadow-lg group-hover:scale-110 rounded-full"></div> --}}
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
            </aside>
            </aside>
        </div>
    </div>
</x-base-layout>