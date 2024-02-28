<div>
    <div class="mt-10 dark:text-white">
        <hr class="dark:border-gray-600 border-gray-200">
        <div>
            <p class="font-semibold text-xl">{{ $this->questions->count() }} comentarios</p>
        </div>
    </div>
    @if(auth()->user()?->email_verified_at)
        <div class="flex mt-2">
            <figure class="mr-4">
                <img
                    class="w-12 h-12 object-cover object-center rounded-full"
                    src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}_photo">
            </figure>

            <div class="flex-1">
                <form wire:submit.prevent="store">
                    <textarea wire:model="message" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm resize-none w-full" placeholder="Escribe tu mensaje"></textarea>

                    @error('message')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Comentar</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        @if (!auth()->user())
            <div class="flex flex-col justify-center align-middle text-center mt-5 p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 rounded-lg shadow">
                <h1 class="dark:text-white text-3xl font-bold text-center mb-3">Inicia sesión para comentar</h1>
                <div class="text-center my-5">
                    <a href="{{ route('login') }}" class="text-white text-lg uppercase font-bold bg-blue-700 rounded-lg px-5 py-3">Iniciar sesión</a>
                </div>
            </div>
        @else
            <div class="flex flex-col justify-center align-middle text-center mt-5 p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 rounded-lg shadow">
                <h1 class="dark:text-white text-3xl font-bold text-center">Verifica tu email para comentar</h1>
            </div>
        @endif
    @endif

    <p class="text-lg font-semibold mt-6 mb-4 dark:text-white">Comentarios:</p>
    <ul class="space-y-6">
        @forelse ($this->questions as $question)
            <li wire:key="question-{{ $question->id }}">
                <div class="flex">
                    <figure class="mr-4">
                        <img class="w-12 h-12 object-cover object-center rounded-full" src="{{ $question->user->profile_photo_url }}" alt="{{ $question->user->name }}_photo">
                    </figure>

                    <div class="flex-1">
                        <p class="font-semibold text-lg dark:text-white">
                            {{ $question->user->name }}
                            <span class="font-normal text-sm dark:text-white">{{ $question->created_at->diffForHumans() }}</span>
                        </p>

                        @if ($question->id == $question_edit['id'])
                            <form wire:submit.prevent="update">
                                <textarea wire:model="question_edit.body" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm resize-none w-full"></textarea>

                                @error('question_edit.body')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror

                                <div class="flex justify-end">
                                    <button wire:click="cancel" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">Cancelar</button>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Actualizar</button>
                                </div>
                            </form>
                        @else
                            <p class="dark:text-white">{{ $question->body }}</p>
                        @endif

                    </div>

                    <div class="ml-6">
                        @if (auth()->id() == $question->user->id)
                            <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                                <div @click="open = !open">
                                    <button class="fas fa-ellipsis-v dark:text-white"></button>
                                </div>

                                <div x-show="open"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-95"
                                        class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                                        style="display: none;"
                                        @click="open = false">
                                    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white dark:bg-gray-700">
                                        <a
                                            wire:click="edit({{ $question->id }})"
                                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out cursor-pointer">
                                                Editar
                                        </a>
                                        <a
                                            wire:click="destroy({{ $question->id }})"
                                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out cursor-pointer">
                                                Eliminar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @livewire('answer', compact('question'), key('answer-'.$question->id))
            </li>
        @empty
            <li class="dark:text-white">No hay comentarios para este post</li>
        @endforelse
    </ul>

    @php
        $quantity = $model->questions()->count() - $showQuantity;
    @endphp

    @if ($quantity > 0 )
        <div class="flex items-center">
            <hr class="flex-1">
            <button
                wire:click="showMoreQuestion"
                class="text-sm font-smibold text-gray-500 dark:text-white mx-4 dark:hover:text-blue-400 hover:text-gray-600">
                Ver @if($quantity > 1) los @endif {{ $quantity }} @if($quantity > 1) comentarios restantes @else comentario restante @endif
            </button>
            <hr class="flex-1">
        </div>
    @endif
</div>
