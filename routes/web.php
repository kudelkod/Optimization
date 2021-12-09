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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('optimization') -> group(function (){
    Route::namespace('App\Http\Controllers\Optimization') -> group(function (){
        Route::get('/', 'OptimizationController@index') ->name('optimization.index');
        Route::post('calculate', 'OptimizationController@calculate')->name('optimization.calculate');
    });
});
