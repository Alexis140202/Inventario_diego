<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TiendaController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/Tiendas', function () {
    return Inertia::render('PagesAdmin/Tiendas/DashboardTiendas');
})->name('tiendas');

Route::get('/CategoriasDashboard', function () {
    return Inertia::render('PagesAdmin/Categorias/DashboardCategorias');
})->name('categorias');


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Tiendas
Route::resource('tiendas', TiendaController::class);

//Categorias
Route::resource('categorias', CategoriasController::class);

//Marca
Route::resource('marcas', MarcaController::class);

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
