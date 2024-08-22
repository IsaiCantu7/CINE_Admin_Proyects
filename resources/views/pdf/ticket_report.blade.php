<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .ticket {
            width: 300px;
            border: 2px solid #000;
            border-radius: 8px;
            padding: 10px;
            margin: 10px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .ticket h1 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 10px;
        }
        .ticket p {
            margin: 5px 0;
            font-size: 14px;
        }
        .ticket .seat {
            font-weight: bold;
        }
    </style>
</head>
<body>
    @if ($venta->quantity > 0 && $venta->seats)
        @php
            $seats = json_decode($venta->seats, true); // Decodificar JSON si es necesario
            if (is_string($seats[0])) {
                $seats = explode(', ', $seats[0]); // Dividir la cadena en elementos individuales
            }
            $totalSeats = count($seats);
        @endphp
        
        @for ($i = 0; $i < $venta->quantity; $i++)
            <div class="ticket">
                <h1>Boleto</h1>
                <p><strong>ID de Ticket:</strong> {{ $venta->id }}</p>
                <p><strong>Película:</strong> {{ $venta->movie->title }}</p>
                <p><strong>Fecha:</strong> {{ $venta->showdate }}</p>
                <p><strong>Hora:</strong> {{ $venta->showtime }}</p>
                <p><strong>Total de Snacks:</strong> ${{ number_format($venta->snack_total / $venta->quantity, 2) }}</p>
                <p class="seat"><strong>Asiento:</strong> {{ $seats[$i] ?? 'N/A' }}</p>
            </div>
        @endfor
    @else
        <p>No hay boletos disponibles para esta venta.</p>
    @endif
</body>
</html>
