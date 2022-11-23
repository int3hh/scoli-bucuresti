<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\DespreComponent;
use App\Http\Livewire\HartaComponent;
use App\Http\Livewire\ListaComponent;
use App\Http\Livewire\RezultateComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HartaComponent::class)->name('index');
Route::get('rezultate', RezultateComponent::class)->name('rezultate');
Route::get('lista', ListaComponent::class)->name('lista');
Route::get('despre', DespreComponent::class)->name('despre');
