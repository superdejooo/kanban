<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ColumnController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});





// kanban API

Route::name('columns.')
    ->group(function (){
        Route::get('/columns', [ColumnController::class, 'index'])->name('index');
        Route::get('/columns/{id}', [ColumnController::class, 'show'])->name('show');
    });

Route::name('cards.')
    ->group(function (){
        Route::get('/cards/{id}', [CardController::class, 'show'])->name('show');
    });
