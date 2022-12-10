<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('article',[ArticleController::class, 'store']);
Route::get('article',[ArticleController::class, 'index']);
Route::get('article/{id}',[ArticleController::class, 'show']);

Route::get('app/{path}', function (string $path){
    return Storage::disk('local')->download(str_replace('-','/',$path));
})->name('local.temp')->middleware('signed');
