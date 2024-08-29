<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esta es un area segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="form-group mt-4">
                <button type="submit">{{ __('Confirmar') }}</button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
