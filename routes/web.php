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


// Route::get('/main', 'App\Http\Controllers\MainController@index');
Route::get('/base', [App\Http\Controllers\BaseReferenceController::class, 'index']);
Route::get('/base/{itemId}', [App\Http\Controllers\BaseReferenceController::class, 'getByItemId']);
Route::get('/base/list/{resourcetype}/{active}', [App\Http\Controllers\BaseReferenceController::class, 'getListByRecourceType']);


Route::post('/base/add/item', [App\Http\Controllers\BaseReferenceController::class, 'addItem']);
Route::put('/base/update/item', [App\Http\Controllers\BaseReferenceController::class, 'updateItem']);


Route::get('/make/migrate/init', [App\Http\Controllers\MakeMigrateWorkerController::class, 'run']);
