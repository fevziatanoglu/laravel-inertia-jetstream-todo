<?php

use App\Http\Controllers\TodoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/todos' , [TodoController:: class , 'todos'])->name('get.todos')->middleware('auth');
    Route::post('/todo/store' , [TodoController:: class , 'store'])->name('store.todo');
    Route::put('/todo/{id}/toggle', [TodoController::class, 'toggle'])->name('toggle.todo');
    Route::put('/todo/{id}/edit', [TodoController::class, 'edit'])->name('edit.todo');
    Route::delete('/todo/{id}', [TodoController::class, 'delete'])->name('delete.todo');
});
