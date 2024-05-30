<?php

namespace Webcasting\Club\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Point;
use Webcasting\Club\Http\Resources\PointHistoryResource;

class PointController extends Controller
{
    public function index()
    {
        return PointHistoryResource::collection(Point::all());
    }
}
