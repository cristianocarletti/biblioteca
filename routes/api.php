<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoresController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\EmprestimosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('autenticar', [AuthController::class, 'autenticar'])->name('auth.autenticar.autenticar');
Route::post('registrar', [UserController::class, 'store'])->name('user.registrar.store');

Route::middleware(['checkBearerToken'])->prefix('v1')->group(function () {

    Route::post('sair', [AuthController::class, 'logout'])->name('sair.logout');

    Route::prefix('autores')->group(function () {

        Route::get('listar', [AutoresController::class, 'index'])->name('autores.listar.index');
        Route::post('criar', [AutoresController::class, 'store'])->name('autores.criar.store');
        Route::put('atualizar/{id}', [AutoresController::class, 'update'])->name('autores.atualizar.update');
        Route::delete('deletar/{id}', [AutoresController::class, 'destroy'])->name('autores.deletar.destroy');
    });

    Route::prefix('livros')->group(function () {

        Route::get('listar', [LivrosController::class, 'index'])->name('livros.listar.index');
        Route::post('criar', [LivrosController::class, 'store'])->name('livros.criar.store');
        Route::put('atualizar/{id}', [LivrosController::class, 'update'])->name('livros.atualizar.update');
        Route::delete('deletar/{id}', [LivrosController::class, 'destroy'])->name('livros.deletar.destroy');
    });
 
    Route::prefix('emprestimos')->group(function () {

        Route::get('listar', [EmprestimosController::class, 'index'])->name('emprestimos.listar.index');
        Route::post('registrar', [EmprestimosController::class, 'store'])->name('emprestimos.registrar.store');
    });
});

// TESTS
Route::prefix('tests')->group(function () {

    Route::post('autenticar', [AuthController::class, 'autenticar'])->name('test.auth.autenticar');
    Route::post('registrar', [UserController::class, 'store'])->name('test.user.store');
    Route::post('sair', [AuthController::class, 'logout'])->name('test.sair.logout');

    // Autores tests
    Route::prefix('autores')->group(function () {

        Route::get('listar', [AutoresController::class, 'index'])->name('test.autores.listar');
        Route::post('criar', [AutoresController::class, 'store'])->name('test.autores.criar');
        Route::put('atualizar/{id}', [AutoresController::class, 'update'])->name('test.autores.atualizar');
        Route::delete('deletar/{id}', [AutoresController::class, 'destroy'])->name('test.autores.deletar');
    });

    // Livros tests
    Route::prefix('livros')->group(function () {

        Route::get('listar', [LivrosController::class, 'index'])->name('test.livros.listar');
        Route::post('criar', [LivrosController::class, 'store'])->name('test.livros.criar');
        Route::put('atualizar/{id}', [LivrosController::class, 'update'])->name('test.livros.atualizar');
        Route::delete('deletar/{id}', [LivrosController::class, 'destroy'])->name('test.livros.deletar');
    });
 
    // Empréstimos tests
    Route::prefix('emprestimos')->group(function () {

        Route::get('listar', [EmprestimosController::class, 'index'])->name('test.emprestimos.listar');
        Route::post('registrar', [EmprestimosController::class, 'store'])->name('test.emprestimos.registrar');
    });
});
