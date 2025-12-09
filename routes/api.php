<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Task\TaskController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Middleware\Checktoken;

Route::middleware([Checktoken::class])->group(function () {


    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    Route::apiResource('tasks', TaskController::class);

});
