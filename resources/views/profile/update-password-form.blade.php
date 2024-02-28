<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{-- {{ __('Update Password') }} --}}
        Actualizar contraseña
    </x-slot>

    <x-slot name="description">
        {{-- {{ __('Ensure your account is using a long, random password to stay secure.') }} --}}
        Introduce una contraseña larga, random y que sea segura.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            {{-- <x-label for="current_password" value="{{ __('Current Password') }}" /> --}}
            <x-label for="current_password" value="Contraseña actual" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            {{-- <x-label for="password" value="{{ __('New Password') }}" /> --}}
            <x-label for="password" value="Nueva contraseña" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            {{-- <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" /> --}}
            <x-label for="password_confirmation" value="Confirmar contraseña" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{-- {{ __('Saved.') }} --}}
            Contraseña cambiada
        </x-action-message>

        <x-button>
            {{-- {{ __('Save') }} --}}
            Guardar
        </x-button>
    </x-slot>
</x-form-section>
