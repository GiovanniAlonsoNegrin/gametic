<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{-- {{ __('Profile Information') }} --}}
        Información del perfil
    </x-slot>

    <x-slot name="description">
        {{-- {{ __('Update your account\'s profile information and email address.') }} --}}
        Actualiza tu información de perfil de la cuenta y email.
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                {{-- <x-label for="photo" value="{{ __('Photo') }}" /> --}}
                <x-label for="photo" value="Foto" />


                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{-- {{ __('Select A New Photo') }} --}}
                    Seleccionar una nueva foto
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{-- {{ __('Remove Photo') }} --}}
                        Eliminar foto
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            {{-- <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" readonly/>
            --}}
            <p class="dark:text-gray-300 my-2 border dark:border-gray-700 border-gray-300 dark:bg-gray-900 py-2 pl-3 rounded">{{ $this->user->email }}</p>
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{-- {{ __('Your email address is unverified.') }} --}}
                    Tu email no está verificado

                    <button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                        {{-- {{ __('Click here to re-send the verification email.') }} --}}
                        Clica aquí para reenviarte el email de verificación.
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{-- {{ __('A new verification link has been sent to your email address.') }} --}}
                        Un nuevo link de verificación ha sido enviado a tu direcicón de email.
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{-- {{ __('Saved.') }} --}}
            Guardado
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{-- {{ __('Save') }} --}}
            Guardar
        </x-button>
    </x-slot>
</x-form-section>
