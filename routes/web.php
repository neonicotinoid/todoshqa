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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/{project}/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('project.tasks')->middleware(['auth']);
Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects')->middleware(['auth']);

Route::view('/ui-library', 'library')->middleware(['prod']);

require __DIR__.'/auth.php';
