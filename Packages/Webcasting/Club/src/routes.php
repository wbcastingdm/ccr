<?php

use Illuminate\Support\Facades\Route;
use Webcasting\Club\Controllers\PointController;
use Webcasting\Club\Facade\ClubFacade;

Route::get('/test', [PointController::class, 'addPoint']);
