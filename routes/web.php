<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeTrackerController;
use App\Http\Controllers\TimeTrackerReportsController;

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

Route::get('/', function () {
    return view('welcome');
});


// redirect to index function in TimeTrackerController
Route::get('/', [TimeTrackerController::class, 'index'])->name('time.logs');

// it will load create log view 
Route::get("/store/logView", function() { return view("createLogView"); })->name('store.logView');

// redirect to storeLog function in TimeTrackerController 
Route::post('/store/log', [TimeTrackerController::class, 'storeLog'])->name('log.time');

// redirect to LoadEditView function in TimeTrackerController
Route::get('/edit/logView/{id}', [TimeTrackerController::class, 'loadEditView'])->name('edit.logView');

// redirect to editLog function in TimeTrackerController
Route::post('/edit/log', [TimeTrackerController::class, 'editLog'])->name('edit.log');

// redirect to destroyLog function in TimeTrackerController
Route::get('/delete/log/{id}', [TimeTrackerController::class, 'destroyLog'])->name('delete.log');


// redirect to index function in TimeTrackerReportsController
Route::get('/reports/{param?}', [TimeTrackerReportsController::class, 'index'])->name('reports.view');