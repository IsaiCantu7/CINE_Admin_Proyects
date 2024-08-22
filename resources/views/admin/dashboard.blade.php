<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard del administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('¡Bienvenido, Administrador!') }}</h3>
                    <p class="mt-2">{{ __('Has iniciado sesión como Administrador.') }}</p>

                    <!-- Sección de Snacks Disponibles -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold">{{ __('Snacks Disponibles') }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                            @foreach ($snacks as $snack)
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $snack->name }}</h5>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $snack->type }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">${{ number_format($snack->price, 2) }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $snack->quantity }} {{ __('Disponibles') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sección de Cartelera de Películas -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold">{{ __('Cartelera de Películas') }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                            @foreach ($movies as $movie)
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                    <!-- Imagen de la Película -->
                                    <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="w-full h-48 object-cover rounded-md mb-2">
                                    <!-- Información de la Película -->
                                    <h5 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $movie->title }}</h5>
                                    <p class="text-gray-600 dark:text-gray-300">{{ __('Director: ') . $movie->director }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">{{ __('Fecha de Lanzamiento: ') . $movie->release_date }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">{{ __('Género: ') . $movie->genre }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">{{ __('Duración: ') . $movie->duration }} min</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
