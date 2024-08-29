<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? No hay problema. ') }}<br>
            {{ __('Ingresa tu correo electrónico y nosotros te haremos ')}}<br>
            {{ __('llegar un correo con un link para que puedas') }}<br>
            {{ __('restablecer tu contraseña.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="form-group">
                <button type="submit">{{ __('Enviar correo') }}</button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
