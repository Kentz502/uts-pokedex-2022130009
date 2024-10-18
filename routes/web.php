<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('pokemon');
// Route::get('/index', [HomeController::class, 'index'])->name('home');
// Route::resource('pokemon', PokemonController::class);
// Route::get('/pokemon', [PokemonController::class, 'index'])->name('index');
Route::resource('pokemon', PokemonController::class)->middleware('auth');


