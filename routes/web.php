<?php

use Webcasting\Club\Club;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('inspire', function (Club $inspire) {
    return $inspire->justDoIt();
});
