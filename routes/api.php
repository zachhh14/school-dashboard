<?php

use App\Http\Controllers\Api\QuizApiController;
use App\Http\Controllers\Api\QuestionnaireApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('reviewer/list', QuizApiController::class)->only([
    'index'
]);

Route::apiResource('quiz', QuizApiController::class)->only([
    'show',
]);

Route::apiResource('questionnaire', QuestionnaireApiController::class)->only([
    'store', 'destroy','show', 'update'
]);
