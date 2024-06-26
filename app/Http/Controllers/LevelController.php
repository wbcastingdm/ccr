<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Level\StoreLevelRequest;
use App\Http\Requests\Level\UpdateLevelRequest;
use App\Http\Resources\LevelResource;
use App\Http\Responses\ErrorResponse;
use App\Models\Level;
use Illuminate\Support\Facades\Cache;

class LevelController extends Controller
{
    public function index()
    {
        return LevelResource::collection(Level::all());
    }

    public function store(StoreLevelRequest $request)
    {
        // TODO - messages and make it multilanguage
        try {
            $level = Level::create($request->validated());
            Cache::forget('levels');
        } catch (\Throwable $th) {
            $message = 'افزودن سطح به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'افزودن سطح با موفقیت انجام شد';
        return response([
            'message' => $msg,
            'data' => new LevelResource($level)
        ]);
    }

    public function update(UpdateLevelRequest $request, int $id)
    {
        // TODO - messages and make it multilanguage
        $level = Level::findOrFail($id);

        try {
            $level->update($request->validated());
            Cache::forget('levels');
        } catch (\Throwable $th) {

            $message = 'افزودن سطح به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'ویرایش سطح با موفقیت انجام شد';
        return response([
            'message' => $msg,
            'data' => new LevelResource($level)
        ]);
    }

    public function destroy(int $id)
    {
        // TODO - messages and make it multilanguage
        // TODO - what about it's gifts !!?
        $level = Level::findOrFail($id);

        try {
            $level->delete();
        } catch (\Throwable $th) {
            $message = 'حذف سطح به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'حذف سطح با موفقیت انجام شد';
        return response([
            'message' => $msg
        ]);
    }
}
