<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//raggruppo le rotte, le faccio controllare da un middleware e ne cambio il nome e prefisso
//name->il nome delle rotte inizia con admin.
//prefix-> tutti gli url della pagina di queste rotte avranno  come prefisso /admin, aiuto l' utente
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    //rotta dashboard gestita da controller mio
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    //volgio gestire i projet sotto autenticazione
    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);

    //Rotta type
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
