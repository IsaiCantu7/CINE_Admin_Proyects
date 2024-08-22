<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Película') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Muestra mensajes de éxito -->
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulario para crear una nueva película -->
                    <form method="POST" action="{{ route('admin.movies.store') }}" enctype="multipart/form-data">
                    @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 dark:text-gray-300">{{ __('Título') }}</label>
                            <input type="text" name="title" id="title" class="form-input mt-1 block w-full @error('title') border-red-500 @enderror text-black" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="director" class="block text-gray-700 dark:text-gray-300">{{ __('Director') }}</label>
                            <input type="text" name="director" id="director" class="form-input mt-1 block w-full @error('director') border-red-500 @enderror text-black" value="{{ old('director') }}" required>
                            @error('director')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="release_date" class="block text-gray-700 dark:text-gray-300">{{ __('Fecha de Lanzamiento') }}</label>
                            <input type="date" name="release_date" id="release_date" class="form-input mt-1 block w-full @error('release_date') border-red-500 @enderror text-black" value="{{ old('release_date') }}" required>
                            @error('release_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="genre" class="block text-gray-700 dark:text-gray-300">{{ __('Género') }}</label>
                            <input type="text" name="genre" id="genre" class="form-input mt-1 block w-full @error('genre') border-red-500 @enderror text-black" value="{{ old('genre') }}" required>
                            @error('genre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="duration" class="block text-gray-700 dark:text-gray-300">{{ __('Duración (minutos)') }}</label>
                            <input type="number" name="duration" id="duration" class="form-input mt-1 block w-full @error('duration') border-red-500 @enderror text-black" value="{{ old('duration') }}" required>
                            @error('duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300">{{ __('Descripción') }}</label>
                            <textarea name="description" id="description" class="form-input mt-1 block w-full @error('description') border-red-500 @enderror text-black">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">{{ __('Horarios para las próximas dos semanas') }}</label>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horarios</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($dates as $date)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $date->format('Y-m-d') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" name="showtimes[{{ $date->format('Y-m-d') }}]" class="form-input mt-1 block w-full text-black" placeholder="Ejemplo: 14:00, 17:00, 20:00" value="{{ old('showtimes.' . $date->format('Y-m-d')) }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @error('showtimes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 dark:text-gray-300">{{ __('Imagen') }}</label>
                            <input type="file" name="image" id="image" class="form-input mt-1 block w-full @error('image') border-red-500 @enderror text-black">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            {{ __('Crear Película') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
