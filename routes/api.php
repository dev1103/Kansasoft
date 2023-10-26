<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::post('add_material', [ApiController::class, 'add_material']);
Route::post('add_type', [ApiController::class, 'add_type']);
Route::post('add_machine', [ApiController::class, 'add_machine']);
Route::get('machine_list', [ApiController::class, 'machine_list']);
Route::get('machine_used_by_material', [ApiController::class, 'machine_used_by_material']);
Route::get('type_material_count_of_machine', [ApiController::class, 'type_material_count_of_machine']);





