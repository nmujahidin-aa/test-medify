<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('master-items')->name('master-items.')->group(function(){
    Route::get('/', [App\Http\Controllers\MasterItemsController::class, 'index'])->name('index');
    Route::get('/search', [App\Http\Controllers\MasterItemsController::class, 'search'])->name('search');
    Route::get('/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formView'])->name('form');
    Route::post('/form/{method}/{id?}', [App\Http\Controllers\MasterItemsController::class, 'formSubmit'])->name('submit');
    Route::get('/view/{kode}', [App\Http\Controllers\MasterItemsController::class, 'singleView'])->name('view');
    Route::delete('/delete/{id}', [App\Http\Controllers\MasterItemsController::class, 'delete'])->name('delete');
    Route::get('/update-random-data', [App\Http\Controllers\MasterItemsController::class, 'updateRandomData'])->name('update-random');
    Route::get('export', [App\Http\Controllers\MasterItemsController::class, 'export'])->name('export');
});

Route::prefix('category-items')->name('category-items.')->group(function(){
    Route::get('/', [App\Http\Controllers\CategoryItemsController::class, 'index'])->name('index');
    Route::get('/search', [App\Http\Controllers\CategoryItemsController::class, 'search'])->name('search');
    Route::get('/form/{method}/{id?}', [App\Http\Controllers\CategoryItemsController::class, 'formView'])->name('form');
    Route::post('/form/{method}/{id?}', [App\Http\Controllers\CategoryItemsController::class, 'formSubmit'])->name('submit');
    Route::get('/view/{kode}', [App\Http\Controllers\CategoryItemsController::class, 'singleView'])->name('view');
    Route::get('/{id}/print', [App\Http\Controllers\CategoryItemsController::class, 'print'])->name('print');
    Route::delete('/delete/{id}', [App\Http\Controllers\CategoryItemsController::class, 'delete'])->name('delete');
});