<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);
Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)
    ->middleware(['auth'])
    ->name('dashboard');

// Projects
Route::controller(ProjectController::class)
    ->prefix('projects')
    ->as('projects.')
    ->middleware(['auth'])
    ->group(function () {
        Route::delete('/{project}/force-delete', [ProjectController::class, 'forceDelete'])->name('force-delete');
        Route::post('/{project}/restore', [ProjectController::class, 'restore'])->name('restore');
        Route::post('/{project}/share', [ProjectController::class, 'share'])->name('share');
        Route::post('/{project}/unshare', [ProjectController::class, 'unshare'])->name('unshare');
    });
Route::resource('projects', ProjectController::class)
    ->middleware(['auth'])
    ->only(['index', 'show', 'store', 'update', 'destroy']);

// Tasks
Route::post('tasks/{task}/toggle', [TaskController::class, 'toggleTaskCompletion'])->name('task.complete')->middleware(['auth']);
Route::post('tasks/{task}/myday', [TaskController::class, 'toggleToMyDay'])->name('task.myday')->middleware(['auth']);
Route::resource('task', TaskController::class)
    ->middleware(['auth'])
    ->only(['show', 'update', 'store', 'destroy']);

// MyDay Page
Route::get('myday', [\App\Http\Controllers\MyDayController::class, 'show'])
    ->middleware(['auth'])
    ->name('myDay');

// Users
Route::get('/profile', [UserController::class, 'show'])->middleware(['auth'])->name('profile');
Route::controller(UserController::class)
    ->prefix('users')
    ->middleware(['auth'])
    ->as('user.')
    ->group(function () {
        Route::post('/{user}', 'update')->name('update');
        Route::delete('/{user}/remove-avatar', 'removeAvatar')->name('removeAvatar');
        Route::post('/{user}/upload-avatar', 'uploadAvatar')->name('uploadAvatar');
    });

require __DIR__.'/auth.php';
