<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Movie;
use App\Models\Snack;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Mostrar el panel de administración con cartelera de películas y snacks disponibles
    public function index()
    {
        $movies = Movie::all(); // Obtener todas las películas
        $snacks = Snack::all(); // Obtener todos los snacks

        return view('admin.dashboard', compact('movies', 'snacks'));
    }

    // Muestra el formulario de creación del vendedor
    public function createSeller()
    {
        return view('admin.create_seller');
    }

    // Maneja el almacenamiento del nuevo vendedor
    public function storeSeller(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => '    required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'seller',
        ]);

        return redirect()->route('admin.sellers.create')->with('success', 'Vendedor creado correctamente'); 
    }


    //Peliculas
// Mostrar el formulario de creación de películas
public function createMovie()
{
    $dates = collect();

    for ($i = 0; $i < 14; $i++) {
        $dates->push(now()->addDays($i));
    }

    return view('admin.create_movies', compact('dates')); 
}


      // Manejar el envío del formulario para crear una nueva película
      public function storeMovie(Request $request)
      {
          // Validar los datos del formulario
          $request->validate([
              'title' => 'required|string|max:255',
              'director' => 'required|string|max:255',
              'release_date' => 'required|date',
              'genre' => 'required|string|max:255',
              'duration' => 'required|integer',
              'description' => 'nullable|string',
              'showtimes' => 'nullable|array',
              'showtimes.*' => 'nullable|string',
              'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          ]);
      
          // Procesar la imagen si está presente
          $imagePath = null;
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              $imagePath = $image->store('peliculas', 'public');
          }
      
          // Crear una nueva película
          Movie::create([
              'title' => $request->input('title'),
              'director' => $request->input('director'),
              'release_date' => $request->input('release_date'),
              'genre' => $request->input('genre'),
              'duration' => $request->input('duration'),
              'description' => $request->input('description'),
              'showtimes' => json_encode($request['showtimes']),
              'image' => $imagePath, 
          ]);
      
          // Redirigir al usuario con un mensaje de éxito
          return redirect()->route('admin.movies.create')->with('success', 'Película creada con éxito.');
      }

      //Snacks

      public function createSnack()
    {
        return view('admin.create_snack'); // Ruta a tu vista create_snack.blade.php
    }

    public function storeSnack(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'quantity' => 'required|integer|min:0',
    ]);

    // Crear un nuevo snack
    Snack::create([
        'name' => $request->input('name'),
        'type' => $request->input('type'),
        'price' => $request->input('price'),
        'description' => $request->input('description'),
        'quantity' => $request->input('quantity'),
    ]);

    // Redirigir al usuario con un mensaje de éxito
    return redirect()->route('admin.snacks.create')->with('success', 'Snack creado con éxito.');
}




}
