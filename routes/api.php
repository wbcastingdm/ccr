<?php

use App\Facade\ClubFacade;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PointController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('add_point', [PointController::class, 'store']);
