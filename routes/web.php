<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});


Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Grupo de rutas pertenecientes al subfijo category, todo relacionado a category va aqui

Route::prefix('/category')->middleware('auth')->group(
    function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categoryIndex'); //esto es la tabla de category 

        Route::get('/register', [CategoryController::class, 'register'])->name('categoryRegister'); // formulario de ingreso 

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categoryEdit');/* formulario de editar (difiere de update, en que 
        edit es la forma visual de cambiar datos y update es registrar esos datos cambiados en la bd) */


        // Rutas http, peticiones al servidor
        Route::post('/create', [CategoryController::class, 'create'])->name('categoryCreate'); // ruta http de Create category

        // Route::get('/read', function () {
        // })->name('categoryRead'); //ruta http de Read category

        Route::patch('/update/{id}', [CategoryController::class, 'update'])->name('categoryUpdate'); // ruta http de Update category

        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('categoryDelete'); // ruta http de Delete category
    }
);