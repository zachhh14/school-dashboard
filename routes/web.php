<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubjectApiController;
use App\Http\Controllers\Api\QuizApiController;
use App\Http\Controllers\ReviewerDashboardController;
use App\Http\Controllers\SchoolDashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('app');
// });
Route::get('/', [SchoolDashboardController::class, 'index']);

Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('create-subject', [SubjectController::class, 'create']);
Route::post('post-subject', [SubjectController::class, 'store']);

Route::get('reviewer-dashboard', [ReviewerDashboardController::class, 'index']);
Route::get('reviewer/{subject_id}', [QuizController::class, 'index'])
    ->name('reviewer');

Route::get('quiz/{id}', [QuizController::class, 'show'])
    ->name('show.quiz');
Route::get('add-question/{id}', [QuizController::class, 'create'])
    ->name('create.quiz');

Route::post('upload/questionnaire', [QuestionnaireController::class, 'import']);

// API routes
Route::apiResource('subject/list', SubjectApiController::class)->only([
    'index'
]);
Route::get('delete-subject/{id}', [SubjectApiController::class, 'destroy']);
Route::post('create-quiz', [QuizController::class, 'store']);


