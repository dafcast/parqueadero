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
    return view('inicio.index');
});

Route::get('/vehiculos/create', function () {
    return view('vehiculos.create');
})->name('vehiculos.create');


Route::get('/demo', function () {
    return view('demo.index');
})->name('demo.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

