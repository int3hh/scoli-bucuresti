<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\DespreComponent;
use App\Http\Livewire\FeedbackForm;
use App\Http\Livewire\HartaComponent;
use App\Http\Livewire\ListaComponent;
use App\Http\Livewire\RezultateComponent;
use App\Models\School;
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

Route::get('/harta', HartaComponent::class)->name('harta');
Route::get('/', RezultateComponent::class)->name('rezultate');
Route::get('lista', ListaComponent::class)->name('index');
Route::get('despre', DespreComponent::class)->name('despre');
Route::get('feedback', FeedbackForm::class)->name('feedback');
