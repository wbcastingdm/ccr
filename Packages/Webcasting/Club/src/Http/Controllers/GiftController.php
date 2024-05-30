<?php

namespace Webcasting\Club\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Webcasting\Club\Http\Requests\Gift\StoreGiftRequest;
use Webcasting\Club\Http\Requests\Gift\UpdateGiftRequest;
use Webcasting\Club\Http\Resources\GiftResource;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gifts = Gift::all();
        return new GiftResource($gifts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGiftRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Gift $gift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gift $gift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGiftRequest $request, Gift $gift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gift $gift)
    {
        //
    }
}
