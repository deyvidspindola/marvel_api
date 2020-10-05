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

    Route::get('/{characterId?}/{endpoint?}', [CharactersController::class, 'index'])
        ->where(['characterId' => '[0-9]+', 'endpoint' => '[a-z]+']);

});

Route::fallback(function () {

    return response()->json([
        'code' => 404,
        'message' => 'Essa rota ainda não foi desenvolvida'
    ], 404);

});
