<x-guest-layout class="pt-0">
    <div class="w-full h-screen flex items-start">
        <div class="relative w-100  h-full  flex-col hidden sm:flex">
            <div class="absolute top-[20%] left-[10%] flex flex-col">
                <h1 class="text-4xl text-white font-bold my-4">Adela de Cornejo</h1>
                <p class="text-xl text-white font-normal">Formando Alumnos de Excelencia</p>
            </div>

            <img src="{{ asset('/build/img/slideshow/Preescolar-adela.webp') }}" alt=""
                class="w-full h-full object-cover">
        </div>

        <div class="w-full sm:w-1/2 h-full bg-white flex flex-col justify-between md:max-w-2xl">
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

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Contraseña') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordar') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Olvidaste tu contraseña?') }}
                            </a>
                        @endif

                        <x-button class="ml-4">
                            {{ __('Iniciar Sesión') }}
                        </x-button>
                    </div>
                </form>

            </x-authentication-card>
        </div>


    </div>
</x-guest-layout>
