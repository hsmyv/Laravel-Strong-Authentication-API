<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', UserController::class);
});
Route::post('register', [UserController::class, 'register']);
// Route::middleware('throttle:1,1,ip')->post('login', [UserController::class, 'login']);
Route::post('login', [UserController::class, 'login']);


Route::apiResource('posts', PostController::class);
