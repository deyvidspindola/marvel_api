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

Route::name('Api.')->prefix('v1/public/characters')->group(function (){

    Route::get('/{characterId?}', [CharactersController::class, 'index'])->where('characterId', '[0-9]+')->name('index');
    Route::get('/{characterId}/comics', [CharactersController::class, 'comics'])->where('characterId', '[0-9]+')->name('comics');
    Route::get('/{characterId}/events', [CharactersController::class, 'events'])->where('characterId', '[0-9]+')->name('events');
    Route::get('/{characterId}/series', [CharactersController::class, 'series'])->where('characterId', '[0-9]+')->name('series');
    Route::get('/{characterId}/stories', [CharactersController::class, 'stories'])->where('characterId', '[0-9]+')->name('stories');

});

Route::fallback(function () {

    return response()->json([
        'code' => 404,
        'message' => 'Essa rota ainda não foi desenvolvida'
    ], 404);

});
