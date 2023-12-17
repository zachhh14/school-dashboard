<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubjectApiController;
use App\Http\Controllers\ReviewerDashboardController;
use App\Http\Controllers\SchoolDashboardController;
use App\Http\Controllers\SubjectController;
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

route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
route::get('create-subject', [SubjectController::class, 'create']);
route::post('post-subject', [SubjectController::class, 'store']);
Route::get('reviewer-dashboard', [ReviewerDashboardController::class, 'index']);
Route::get('reviewer/{subject_id}', [QuizController::class, 'index'])
    ->name('reviewer');

// API routes
Route::apiResource('subject/list', SubjectApiController::class)->only([
    'index'
]);
route::get('delete-subject/{id}', [SubjectApiController::class, 'destroy']);

