<?php

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\guest\HomeController as GuestHomeController;
use App\Http\Controllers\admin\ProjectController as AdminProjectController;
use App\Http\Controllers\admin\TechnologyController as AdminTechnologyController;
use App\Http\Controllers\admin\TypeController;
use App\Http\Controllers\guest\ProjectController as GuestProjectController;
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


/* HOME UTENTE */
Route::get('/', GuestHomeController::class )->name('guest.home');

/* INDEX */
Route::get('/projects', [GuestProjectController::class, 'index'])->name('guest.projects.index');

/* SHOW */
Route::get('/projects/{slug}', [GuestProjectController::class, 'show'])->name('guest.projects.show');



/* ----------------------------- ADMIN -------------------------------- */

Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function(){
    
    /* HOME */ 
    Route::get('', AdminHomeController::class)->name('home');

    /* CESTINO ELEMENTO */
    Route::get('/projects/trash', [AdminProjectController::class, 'trash'])->name('projects.trash');

    /* RIPRISTINI ELEMENTO */
    Route::patch('/projects/{project}/restore', [AdminProjectController::class, 'restore'])->name('projects.restore');

    /* ELIMINI DEFINITIVAMENTE L'ELEMENTO */
    Route::delete('/projects/{project}/drop', [AdminProjectController::class, 'drop'])->name('projects.drop');

    /* SVUOTA TUTTO IL CESTINO */
    Route::delete('/projects/empty', [AdminProjectController::class, 'empty'])->name('projects.empty');

    /* ROTTA SWITCH */
    Route::patch('/projects/{project}/switch', [AdminProjectController::class, 'togglePublication'])->name('projects.switch');

    /* TUTTE LE ROTTE E RECUPERO CON WITRASHED ANCHE GLI ELEMENTI ELIMINATI*/
    Route::resource('projects', AdminProjectController::class)->withTrashed(['show', 'edit', 'update']);

    /* INDEX TUTTI GLI ELEMENTI
    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index')->middleware('auth');
    
    /* CREATE CREI ELEMENTO
    Route::get('/projects/create', [AdminProjectController::class, 'create'])->name('projects.create')->middleware('auth');
    
    /* SHOW SINGOLO ELEMENTO
    Route::get('/projects/{project}', [AdminProjectController::class, 'show'])->name('projects.show')->middleware('auth');
    
    /* STORE SALVI ELEMENTO CREATO
    Route::post('/projects', [AdminProjectController::class, 'store'])->name('projects.store')->middleware('auth');
    
    /* EDIT MODIFICHI ELEMENTO
    Route::get('/projects/{project}/edit', [AdminProjectController::class, 'edit'])->name('projects.edit')->middleware('auth');
    
    /* UPDATE SLAVI MODIFICHE ELEMENTO
    Route::put('/projects/{project}', [AdminProjectController::class, 'update'])->name('projects.update')->middleware('auth');
    
    /* DESTROY METTI NEL CESTINO
    Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy')->middleware('auth'); */

    
    /* TUTTE LE ROTTE ADMIN TYPES TRANNE LA SHOW */
    Route::resource('/types', TypeController::class)->except('show');

    /* TUTTE LE ROTTE ADMIN TECHNOLOGIES TRANNE LA SHOW */
    Route::resource('/technologies', AdminTechnologyController::class)->except('show');
    
});

/* ---------------------------------------------------------------------------------------------------------- */

/* ROTTE PROFILO */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';