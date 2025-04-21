<?php

use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Task\TaskTimeTrackerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/tasks', TaskController::class);
    // Route::resource('/time-tracker', TaskTimeTrackerController::class);
    Route::post('/start-task-timer/{Id}', [TaskTimeTrackerController::class, 'startTaskTimer']);
    Route::post('/stop-task-timer/{Id}', [TaskTimeTrackerController::class, 'stopTaskTimer']);
    Route::get('/task-time-duration/{Id}', [TaskTimeTrackerController::class, 'taskTimerDuration']);
});
