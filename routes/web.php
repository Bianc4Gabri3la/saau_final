<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAnimalController;
use App\Http\Controllers\Admin\AdoptionRequestController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RaffleController;
use App\Http\Controllers\Admin\VaccineController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ReportController;

// ----------------------------------------------------
// Rotas públicas
// ----------------------------------------------------
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/animais', [PublicController::class, 'animals'])->name('animals');
Route::get('/animal/{id}', [PublicController::class, 'animalShow'])->name('animal.show');
Route::post('/animal/{id}/adotar', [PublicController::class, 'adoptionRequest'])->name('adoption.request');

Route::get('/eventos', [PublicController::class, 'events'])->name('events');
Route::get('/rifas', [PublicController::class, 'raffles'])->name('raffles');
Route::get('/stories', [PublicController::class, 'stories'])->name('stories.index');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/como-funciona', function () {
    return view('how-it-works');
})->name('how-it-works');

Route::get('/como-ajudar', function () {
    return view('how-to-help');
})->name('how-to-help');

// ----------------------------------------------------
// Autenticação para adotantes (site público)
// ----------------------------------------------------
Auth::routes();

// ----------------------------------------------------
// /admin -> redireciona conforme o papel do usuário
// ----------------------------------------------------
Route::get('/admin', function () {
    if (auth()->check() && in_array(auth()->user()->role, ['admin', 'vet'])) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.login');
});

// ----------------------------------------------------
// Autenticação para admin (painel)
// ----------------------------------------------------
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ----------------------------------------------------
// Rotas admin (protegidas - middleware 'admin')
// ----------------------------------------------------
Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUDs principais
        Route::resource('animals', AdminAnimalController::class);
        Route::resource('adoption-requests', AdoptionRequestController::class);
        Route::resource('events', EventController::class);
        Route::resource('raffles', RaffleController::class);
        Route::resource('vaccines', VaccineController::class)->except(['show']);
        Route::resource('donations', DonationController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);

        // Histórias de Adoção
        Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
        Route::patch('/stories/{story}/approve', [StoryController::class, 'approve'])->name('stories.approve');
        Route::delete('/stories/{story}', [StoryController::class, 'destroy'])->name('stories.destroy');

        // 🔹 Relatórios
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    });
