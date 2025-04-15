<?php

use App\Http\Controllers\Project\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/projects', ProjectController::class);
});
