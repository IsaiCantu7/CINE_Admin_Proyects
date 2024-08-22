<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MovieImageController;


Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->rol === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->rol === 'seller') {
        return redirect()->route('seller.dashboard');
    } elseif ($user->rol === 'client') {
        return redirect()->route('client.dashboard');
    } else {
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');



// Rutas específicas para el admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/create_seller', [AdminController::class, 'createSeller'])->name('admin.sellers.create');
    Route::post('/admin/create_seller', [AdminController::class, 'storeSeller'])->name('admin.sellers.store');
    Route::get('/admin/movies/create', [AdminController::class, 'createMovie'])->name('admin.movies.create');
    Route::post('/admin/movies/create', [AdminController::class, 'storeMovie'])->name('admin.movies.store');
    Route::get('/admin/snacks/create', [AdminController::class, 'createSnack'])->name('admin.snacks.create');
    Route::post('/admin/snacks/create', [AdminController::class, 'storeSnack'])->name('admin.snacks.store');
});

// Rutas específicas para el seller
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/seller/snacks/create', [SellerController::class, 'createSnack'])->name('seller.snacks.create');
    Route::post('/seller/snacks/create', [SellerController::class, 'storeSnack'])->name('seller.snacks.store');
    Route::get('/seller/movies/create', [SellerController::class, 'createMovie'])->name('seller.movies.create');
    Route::post('/seller/movies/create', [SellerController::class, 'storeMovie'])->name('seller.movies.store');
    Route::get('/seller/tickets/create', [SellerController::class, 'createTicket'])->name('seller.tickets.create'); // Adjusted route name
    Route::post('/seller/tickets', [SellerController::class, 'storeTicket'])->name('seller.tickets.store');
    Route::get('/api/movies/{movie}/showtimes', [SellerController::class, 'getShowtimes']);
    Route::get('/seller/reports', [SellerController::class, 'showReports'])->name('seller.reports');
    Route::get('/ticket-report/{id}', [PDFController::class, 'downloadTicketReport'])->name('ticket.report');
});


// Rutas específicas para el client
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/client/reports', [ClientController::class, 'showReports'])->name('client.reports');
    Route::get('/client/tickets/create', [ClientController::class, 'createTicket'])->name('client.tickets.create'); // Adjusted route name
    Route::post('/client/tickets', [ClientController::class, 'storeTicket'])->name('client.tickets.store');
    Route::get('/api/movies/{movie}/showtimes', [SellerController::class, 'getShowtimes']);
    Route::get('/ticket-report/{id}', [PDFController::class, 'downloadTicketReport'])->name('ticket.report');


});

// Rutas para el perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
