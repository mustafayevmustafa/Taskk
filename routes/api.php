<?php

use App\Http\Controllers\Api\ArticleController;
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

Route::post('article',[ArticleController::class, 'store']);
Route::get('article',[ArticleController::class, 'index']);
Route::get('article/{id}',[ArticleController::class, 'show']);
Route::get('app/{path}',[ArticleController::class, 'getImage'])->name('local.temp')->middleware('signed');

