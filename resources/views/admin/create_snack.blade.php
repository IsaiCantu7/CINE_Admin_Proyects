<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Snack') }}
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

                    <!-- Formulario para crear un nuevo snack -->
                    <form method="POST" action="{{ route('admin.snacks.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full @error('name') border-red-500 @enderror text-black" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 dark:text-gray-300">{{ __('Tipo') }}</label>
                            <input type="text" name="type" id="type" class="form-input mt-1 block w-full @error('type') border-red-500 @enderror text-black" value="{{ old('type') }}" required>
                            @error('type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 dark:text-gray-300">{{ __('Precio') }}</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-input mt-1 block w-full @error('price') border-red-500 @enderror text-black" value="{{ old('price') }}" required>
                            @error('price')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300">{{ __('Descripción') }}</label>
                            <textarea name="description" id="description" class="form-input mt-1 block w-full @error('description') border-red-500 @enderror text-black" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 dark:text-gray-300">{{ __('Cantidad Disponible') }}</label>
                            <input type="number" name="quantity" id="quantity" class="form-input mt-1 block w-full @error('quantity') border-red-500 @enderror text-black" value="{{ old('quantity') }}" required>
                            @error('quantity')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            {{ __('Crear Snack') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
