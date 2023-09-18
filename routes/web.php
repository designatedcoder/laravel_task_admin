<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', WelcomeController::class)->name('welcome');

Route::middleware('auth:sanctum', config('jetstream.auth_session'),'verified')->group(function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::patch('/tasks/{task}/toggle', [TasksController::class, 'toggle'])->name('tasks.toggle');

    Route::resource('tasks', TasksController::class)->except('edit');
});
