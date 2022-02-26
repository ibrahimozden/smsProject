<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ReportController;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('user', [ApiController::class, 'get_user']);
    Route::get('reports', [ReportController::class, 'index']);
    Route::get('filter_reports', [ReportController::class,'filter_report']);
    Route::get('reports/{id}', [ReportController::class, 'show']);
    Route::post('reports', [ReportController::class, 'store']);
    Route::put('update/{report}',  [ReportController::class, 'update']);
    Route::delete('delete/{report}',  [ReportController::class, 'destroy']);
   

});