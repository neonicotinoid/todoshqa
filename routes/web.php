<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'tasks' => \App\Models\Task::query()->get()->append('is_completed'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth'])->name('dashboard');
Route::get('/profile', [\App\Http\Controllers\UserController::class, 'show'])->middleware(['auth'])->name('profile');

Route::resource('project', \App\Http\Controllers\ProjectController::class)
    ->middleware(['auth'])
    ->only(['index', 'show']);

Route::resource('task', \App\Http\Controllers\TaskController::class)
    ->middleware(['auth'])
    ->only(['show', 'update', 'store', 'destroy']);

Route::post('task/{task}/toggle', [\App\Http\Controllers\TaskController::class, 'completeTask'])->name('task.complete')->middleware(['auth']);
Route::post('task/{task}/myday', [\App\Http\Controllers\TaskController::class, 'toggleToMyDay'])->name('task.myday')->middleware(['auth']);

Route::get('myday', [\App\Http\Controllers\TaskController::class, 'myDay'])
    ->middleware(['auth'])
    ->name('myDay');

Route::view('/ui-library', 'library')->middleware(['prod']);

require __DIR__.'/auth.php';
