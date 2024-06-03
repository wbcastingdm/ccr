<?php

namespace App\Http\Controllers;

use App\Facade\ClubFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Point\StorePointRequest;
use App\Http\Resources\PointHistoryResource;
use App\Http\Responses\ErrorResponse;
use App\Models\Point;

class PointController extends Controller
{
    public function index()
    {
        return PointHistoryResource::collection(Point::all());
    }

    public function store(StorePointRequest $request)
    {
        return ClubFacade::addPoint($request->phone, $request->type_id, $request->subject, $request->point);
    }

    public function getPoint($phone)
    {
    }
}
