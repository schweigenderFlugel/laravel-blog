<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\PetitionController;

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

# Route::get('/petitions', [PetitionController::class, 'index']); 
# Route::post('/petitions', [PetitionController::class, 'store']); 

Route::apiResource('/petitions', PetitionController::class)->middleware('auth:sanctum');
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show'])->middleware('auth:sanctum'); 

Route::post('/login', [ApiLoginController::class, 'login']);