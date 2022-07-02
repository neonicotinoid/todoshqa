<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth'])->name('dashboard');
Route::get('/profile', [\App\Http\Controllers\UserController::class, 'show'])->middleware(['auth'])->name('profile');

Route::resource('project', \App\Http\Controllers\ProjectController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

Route::resource('task', \App\Http\Controllers\TaskController::class)
    ->middleware(['auth'])
    ->only(['show']);

Route::get('myday', [\App\Http\Controllers\TaskController::class, 'myDay'])
    ->middleware(['auth'])
    ->name('myDay');

Route::view('/ui-library', 'library')->middleware(['prod']);

require __DIR__.'/auth.php';
