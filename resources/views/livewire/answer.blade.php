<div class="pl-16">
    <button type="button" wire:click="$set('answer_create.open', true)" class="dark:text-white">
        <i class="fas fa-reply dark:text-white"></i>
        Responder
    </button>

    @if ($answer_create['open'])
        <div class="flex mt-5">
            <figure class="mr-4">
                <img
                    class="w-12 h-12 object-cover object-center rounded-full"
                    src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}_photo">
            </figure>

            <div class="flex-1">
                <form wire:submit.prevent="store()">
                    <textarea wire:model="answer_create.body" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm resize-none w-full" placeholder="Escribe tu respuesta"></textarea>

                    @error('answer_create.body')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end">
                        <button wire:click="$set('answer_create.open', false)" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">Cancelar</button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Responder</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($question->answers()->count())
        <div class="mt-2">
            <i class="fas @if ($this->showQuantity < $this->question->answers()->count()) fa-chevron-up @else fa-chevron-down @endif dark:text-cyan-200"></i>
            <button wire:click="showAnswers"
                class="font-semibold text-blue-500 dark:text-cyan-200">
                @if ($this->showQuantity < $this->question->answers()->count())
                    Mostrar respuestas
                @else
                    Ocultar respuestas
                @endif
            </button>
        </div>
    @endif

    <ul class="space-y-6 mt-2">
        @forelse ($this->answers as $answer)
            <li wire:key="answer-{{ $answer->id }}">
                <div class="flex">
                    <figure class="mr-4">
                        <img
                            class="w-12 h-12 object-cover object-center rounded-full"
                            src="{{ $answer->user->profile_photo_url }}"
                            alt="{{ $answer->user->name }}_photo">
                    </figure>

                    <div class="flex-1">
                        <p class="font-semibold text-lg dark:text-white">
                            {{ $answer->user->name }}
                            <span class="font-normal text-sm dark:text-white">{{ $answer->created_at->diffForHumans() }}</span>
                        </p>

                        @if ($answer->id == $answer_edit['id'])
                            <form wire:submit.prevent="update">
                                <textarea wire:model="answer_edit.body" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm resize-none w-full"></textarea>

                                @error('answer_edit.body')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror

                                <div class="flex justify-end">
                                    <button wire:click="cancel" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">Cancelar</button>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Actualizar</button>
                                </div>
                            </form>
                        @else
                            <p class="dark:text-white">{{ $answer->body }}</p>

                            <button
                                wire:click="$set('answer_to_answer.id', {{ $answer->id }})"
                                class="dark:text-white">
                                <i class="fas fa-reply dark:text-white"></i>
                                Responder
                            </button>
                        @endif
                    </div>
                    <div class="ml-6">
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
                                        wire:click="edit({{ $answer->id }})"
                                        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out cursor-pointer">
                                            Editar
                                    </a>
                                    <a
                                        wire:click="destroy({{ $answer->id }})"
                                        class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out cursor-pointer">
                                            Eliminar
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($answer_to_answer['id'] == $answer->id)
                    <div class="flex mt-4">
                        <figure class="mr-4">
                            <img
                                class="w-12 h-12 object-cover object-center rounded-full"
                                src="{{ $answer->user->profile_photo_url }}"
                                alt="{{ $answer->user->name }}_photo">
                        </figure>

                        <div class="flex-1">
                            <p class="font-semibold text-lg dark:text-white">
                                {{ $answer->user->name }}
                                <span class="font-normal text-sm dark:text-white">{{ $answer->created_at->diffForHumans() }}</span>
                            </p>

                            <form wire:submit.prevent="answer_to_answer_store">
                                <textarea wire:model="answer_to_answer.body" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm resize-none w-full"></textarea>

                                @error('question_edit.body')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror

                                <div class="flex justify-end">
                                    <button wire:click="$set('answer_to_answer.id', null)" type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">Cancelar</button>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Responder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </li>
        @empty
        @endforelse
    </ul>
</div>
