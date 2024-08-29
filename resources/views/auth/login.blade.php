<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label><br>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Contraseña') }}</label><br>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>

            <div class="form-group checkbox-label">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Recuérdame') }}</span>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña? ') }}
                    </a>
                @endif
        
                <button type="submit" class="btn btn-primary">
                    {{ __('Iniciar sesión') }}
                </button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
