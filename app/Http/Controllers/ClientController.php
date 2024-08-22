<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Ticket;
use App\Models\Snack;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Muestra el dashboard del cliente.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtén todas las películas disponibles
        $movies = Movie::all();

        // Obtén todos los snacks disponibles
        $snacks = Snack::all();

        // Retorna la vista con las películas y snacks
        return view('client.dashboard', [
            'movies' => $movies,
            'snacks' => $snacks
        ]);
    }

    /**
     * Muestra el reporte de compras del cliente.
     *
     * @return \Illuminate\View\View
     */
    public function showReports()
    {
        // Obtener el cliente autenticado
        $cliente = auth()->user();
        
        // Obtener las ventas relacionadas con el cliente autenticado
        $ventas = Ticket::where('client_id', $cliente->id)->get();
        
        // Retornar la vista con las ventas del cliente
        return view('client.reports', compact('cliente', 'ventas'));
    }
    

    public function createTicket()
    {
        $movies = Movie::all(); // Obtén todas las películas disponibles7
        $snacks = Snack::all(); // Obtén todos los snacks disponibles
        $clients = User::where('rol', 'client')->get(); // Obtén solo los usuarios con rol 'client'
        return view('client.sell_tickets', compact('movies', 'snacks', 'clients')); // Ruta a tu vista sell_tickets.blade.php
    }


    public function storeTicket(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'client_id' => 'required|exists:users,id',
            'showdate' => 'required|date',
            'showtime' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'seats' => 'required|array',
            'seats.*' => 'required|string',
            'snacks' => 'nullable|array',
            'snacks.*' => 'nullable|exists:snacks,id',
            'snack_quantities' => 'nullable|array',
            'snack_quantities.*' => 'nullable|integer|min:1',
            'snack_total' => 'nullable|numeric|min:0',
        ]);
    
        // Combinar snacks y sus cantidades
        $snacks = $request->input('snacks', []);
        $quantities = $request->input('snack_quantities', []);
        $snacksData = [];
        $totalPrice = 0;
    
        foreach ($snacks as $index => $snack) {
            if (isset($quantities[$index])) {
                $snackPrice = Snack::find($snack)->price; // Obtener el precio del snack
                $quantity = $quantities[$index];
                $totalPrice += $snackPrice * $quantity; // Calcular el total
                $snacksData[] = [
                    'snack_id' => $snack,
                    'quantity' => $quantity,
                ];
            }
        }
    
        // Crear una nueva venta de boletos
        Ticket::create([
            'movie_id' => $validated['movie_id'],
            'client_id' => $validated['client_id'],
            'showdate' => $validated['showdate'],
            'showtime' => $validated['showtime'],
            'quantity' => $validated['quantity'],
            'seats' => json_encode($validated['seats']),
            'snacks' => json_encode($snacksData), // Guardar snacks como JSON
            'snack_total' => $totalPrice, // Guardar el total de los snacks
        ]);
    
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('client.tickets.create')->with('success', 'Boletos vendidos con éxito.');
    }
    

public function getShowtimes($movieId)
{
    $movie = Movie::find($movieId);
    
    if (!$movie) {
        return response()->json(['error' => 'Película no encontrada'], 404);
    }

    $showtimes = json_decode($movie->showtimes, true);

    if (!is_array($showtimes)) {
        $showtimes = [];
    }

    return response()->json(['showtimes' => $showtimes]);
}
}
