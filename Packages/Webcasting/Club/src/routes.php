<?php

use Illuminate\Support\Facades\Route;
use Webcasting\Club\Controllers\PointController;

Route::get('/test', [PointController::class, 'addPoint']);
