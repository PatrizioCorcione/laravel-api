<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/project', [ProjectController::class, 'index']);
Route::get('/type', [ProjectController::class, 'indexType']);
Route::get('/technology', [ProjectController::class, 'indexTechno']);
Route::get('/project/search/{title}', [ProjectController::class, 'search']);
