<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\SchoolDashboardController;
use App\Http\Controllers\SubjectController;

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

route::get('subjects', [SubjectController::class, 'index']);
route::get('create-subject', [SubjectController::class, 'create']);
route::post('post-subject', [SubjectController::class, 'store']);
