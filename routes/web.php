<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;

// ─── Página inicial pública ───────────────────────────────────────────────────
Route::get('/', function () {
    return view('home');
})->name('home');

// ─── Autenticação ─────────────────────────────────────────────────────────────
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Área administrativa (protegida por auth) ─────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Produtos
    Route::resource('produtos', ProdutoController::class);

    // CRUD Pedidos
    Route::resource('pedidos', PedidoController::class);
});
