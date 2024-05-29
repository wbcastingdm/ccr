<?php

namespace Webcasting\Club\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Point;

class PointController extends Controller
{
    public function index()
    {
        return Point::all();
    }
}
