<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comprar Boletos') }}
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

                    <!-- Formulario para vender boletos -->
                    <form method="POST" action="{{ route('client.tickets.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="client_id" class="block text-gray-700 dark:text-gray-300">{{ __('Cliente') }}</label>
                            <select name="client_id" id="client_id" class="form-input mt-1 block w-full @error('client_id') border-red-500 @enderror text-black" required>
                                <option value="">Seleccionar un cliente</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }} - {{ $client->email }}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="movie_id" class="block text-gray-700 dark:text-gray-300">{{ __('Película') }}</label>
                            <select name="movie_id" id="movie_id" class="form-input mt-1 block w-full @error('movie_id') border-red-500 @enderror text-black" required>
                                <option value="">Seleccionar una película</option>
                                @foreach ($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->title }} - {{ $movie->release_date }}</option>
                                @endforeach
                            </select>
                            @error('movie_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="showdate" class="block text-gray-700 dark:text-gray-300">{{ __('Fecha') }}</label>
                            <select name="showdate" id="showdate" class="form-input mt-1 block w-full @error('showdate') border-red-500 @enderror text-black" required>
                                <option value="">Seleccionar una fecha</option>
                                <!-- Opciones de fechas se llenarán dinámicamente -->
                            </select>
                            @error('showdate')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="showtime" class="block text-gray-700 dark:text-gray-300">{{ __('Hora') }}</label>
                            <select name="showtime" id="showtime" class="form-input mt-1 block w-full @error('showtime') border-red-500 @enderror text-black" required>
                                <option value="">Seleccionar una hora</option>
                                <!-- Opciones de horas se llenarán dinámicamente -->
                            </select>
                            @error('showtime')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 dark:text-gray-300">{{ __('Número de Boletos') }}</label>
                            <input type="number" name="quantity" id="quantity" class="form-input mt-1 block w-full @error('quantity') border-red-500 @enderror text-black" value="{{ old('quantity') }}" required>
                            @error('quantity')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="seats" class="block text-gray-700 dark:text-gray-300">{{ __('Asientos') }}</label>
                            <input type="text" name="seats[]" id="seats" class="form-input mt-1 block w-full @error('seats') border-red-500 @enderror text-black" value="{{ old('seats.0') }}" placeholder="Ingrese los números de asientos separados por comas">
                            @error('seats')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Sección para snacks -->
                        <div id="snack-section" class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300">{{ __('Snacks') }}</label>
                            <div id="snack-container">
                                <div class="flex items-center mb-2">
                                    <select name="snacks[]" class="form-input mt-1 block w-full text-black" required>
                                        <option value="">Seleccionar un snack</option>
                                        @foreach ($snacks as $snack)
                                            <option value="{{ $snack->id }}" data-price="{{ $snack->price }}">{{ $snack->name }} - ${{ $snack->price }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number"  name="snack_quantities[]" class="form-input mt-1 ml-2 w-24 text-black" min="1" placeholder="Cantidad" required>
                                </div>
                            </div>
                            <div class="mt-2">
                                <strong>Total: $<span id="snack-total">0.00</span></strong>
                            </div>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            {{ __('Vender Boletos') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('movie_id').addEventListener('change', function() {
            var movieId = this.value;
            var showdateSelect = document.getElementById('showdate');
            var showtimeSelect = document.getElementById('showtime');

            if (movieId) {
                fetch(`/api/movies/${movieId}/showtimes`)
                    .then(response => response.json())
                    .then(data => {
                        showdateSelect.innerHTML = '<option value="">Seleccionar una fecha</option>';
                        showtimeSelect.innerHTML = '<option value="">Seleccionar una hora</option>';

                        if (data.showtimes && typeof data.showtimes === 'object') {
                            Object.keys(data.showtimes).forEach(date => {
                                var option = document.createElement('option');
                                option.value = date;
                                option.textContent = date;
                                showdateSelect.appendChild(option);
                            });
                        } else {
                            console.error('Los horarios no están en el formato esperado.');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los horarios:', error);
                    });
            } else {
                showdateSelect.innerHTML = '<option value="">Seleccionar una fecha</option>';
                showtimeSelect.innerHTML = '<option value="">Seleccionar una hora</option>';
            }
        });

        document.getElementById('showdate').addEventListener('change', function() {
            var selectedDate = this.value;
            var showtimeSelect = document.getElementById('showtime');

            if (selectedDate) {
                var movieId = document.getElementById('movie_id').value;

                fetch(`/api/movies/${movieId}/showtimes`)
                    .then(response => response.json())
                    .then(data => {
                        showtimeSelect.innerHTML = '<option value="">Seleccionar una hora</option>';

                        if (data.showtimes && typeof data.showtimes === 'object') {
                            var availableTimes = data.showtimes[selectedDate];
                            if (availableTimes) {
                                availableTimes.split(',').forEach(time => {
                                    var option = document.createElement('option');
                                    option.value = time.trim();
                                    option.textContent = time.trim();
                                    showtimeSelect.appendChild(option);
                                });
                            }
                        } else {
                            console.error('Los horarios no están en el formato esperado.');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los horarios:', error);
                    });
            } else {
                showtimeSelect.innerHTML = '<option value="">Seleccionar una hora</option>';
            }
        });
    </script>

<script>
        // Función para calcular el total de snacks
        function calculateSnackTotal() {
            const snackContainer = document.getElementById('snack-container');
            const snackSelects = snackContainer.querySelectorAll('select[name="snacks[]"]');
            const snackQuantities = snackContainer.querySelectorAll('input[name="snack_quantities[]"]');
            let total = 0;

            snackSelects.forEach((select, index) => {
                const price = parseFloat(select.options[select.selectedIndex].getAttribute('data-price')) || 0;
                const quantity = parseInt(snackQuantities[index].value) || 0;
                total += price * quantity;
            });

            document.getElementById('snack-total').textContent = total.toFixed(2);
        }

        // Añadir eventos para recalcular el total cuando se cambie la selección o la cantidad
        document.getElementById('snack-container').addEventListener('change', function(event) {
            if (event.target.matches('select[name="snacks[]"]') || event.target.matches('input[name="snack_quantities[]"]')) {
                calculateSnackTotal();
            }
        });

        document.getElementById('snack-container').addEventListener('input', function(event) {
            if (event.target.matches('input[name="snack_quantities[]"]')) {
                calculateSnackTotal();
            }
        });
    </script>
    
</x-app-layout>
