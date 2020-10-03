<?php

use App\Http\Controllers\Api\CharactersController;
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


Route::name('Api.')->prefix('v1/public/characters')->group(function (){

    Route::get('/{characterId?}', [CharactersController::class, 'index'])->name('index');
    Route::get('/{characterId}/comics', [CharactersController::class, 'comics'])->name('comics');
    Route::get('/{characterId}/events', [CharactersController::class, 'events'])->name('events');
    Route::get('/{characterId}/series', [CharactersController::class, 'series'])->name('series');
    Route::get('/{characterId}/stories', [CharactersController::class, 'stories'])->name('stories');

});
