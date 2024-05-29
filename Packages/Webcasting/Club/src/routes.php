<?php

use Illuminate\Support\Facades\Route;
use Webcasting\Club\Http\Controllers\LevelController;
use Webcasting\Club\Http\Controllers\PointController;
use Webcasting\Club\Facade\ClubFacade;

Route::get('/test', [PointController::class, 'addPoint']);
Route::get('/addpoint', function () {
    ClubFacade::addPoint('haminjoori ...', 50);
});

Route::prefix('api/club/')->group(function () {
    Route::get('/points', [PointController::class, 'index'])->name('points');

    Route::apiResource('levels', LevelController::class);
});
