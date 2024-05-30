<?php

use Illuminate\Support\Facades\Route;
use Webcasting\Club\Http\Controllers\LevelController;
use Webcasting\Club\Http\Controllers\PointController;
use Webcasting\Club\Facade\ClubFacade;
use Webcasting\Club\Http\Controllers\GiftController;
use Webcasting\Club\Http\Controllers\UserTypeController;

Route::get('/addpoint', function () {
    ClubFacade::addPoint('haminjoori ...', 50);
});

Route::prefix('api/club/')->group(function () {
    Route::get('/points', [PointController::class, 'index'])->name('points');

    Route::apiResource('levels', LevelController::class);
    Route::apiResource('types', UserTypeController::class);
    Route::post('/types/assign', [UserTypeController::class, 'typeAssign']);

    Route::apiResource('gifts', GiftController::class);
});
