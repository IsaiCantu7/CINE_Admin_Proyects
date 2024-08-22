<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Vendedor') }}
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

                    <!-- Formulario para crear un nuevo vendedor -->
                    <form method="POST" action="{{ route('admin.sellers.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-white">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full @error('name') border-red-500 @enderror text-black" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-white">{{ __('Correo Electrónico') }}</label>
                            <input type="email" name="email" id="email" class="form-input mt-1 block w-full @error('email') border-red-500 @enderror text-black" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-white">{{ __('Contraseña') }}</label>
                            <input type="password" name="password" id="password" class="form-input mt-1 block w-full @error('password') border-red-500 @enderror text-black" required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-white">{{ __('Confirmar Contraseña') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input mt-1 block w-full text-black" required>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            {{ __('Crear Vendedor') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
