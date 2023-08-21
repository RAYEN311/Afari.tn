<?php

use App\Http\Controllers\afari_users_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use laravel\sanctum\NewAccessToken ;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('/tokens/create',[afari_users_controller::class, 'createToken']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request){
//     return $request->user();
// });



Route::get('index', [afari_users_controller::class , 'index']);
Route::post('login', [afari_users_controller::class , 'login']);
Route::post('register', [afari_users_controller::class , 'register']);

Route::get('{route}' , function(string $route){
    return response()->json([
        'message' => $route.' is invalide request'
    ]);
});