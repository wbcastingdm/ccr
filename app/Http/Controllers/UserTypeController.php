<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Type\StoreTypeRequest;
use App\Http\Requests\Type\TypeAssignRequest;
use App\Http\Requests\Type\UpdateTypeRequest;
use App\Http\Responses\ErrorResponse;
use App\Models\Level;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Cache;

class UserTypeController extends Controller
{
    public function index()
    {
        $types = UserType::all();
        return response([
            'data' => $types
        ]);
    }

    public function store(StoreTypeRequest $request)
    {
        // TODO - messages and make it multilanguage
        try {
            $userType = UserType::create($request->validated());
        } catch (\Throwable $th) {
            $message = 'افزودن نوع کاربر به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'افزودن نوع کاربر با موفقیت انجام شد';
        return response([
            'message' => $msg,
            'data' => $userType
        ]);
    }

    public function update(UpdateTypeRequest $request, int $id)
    {
        // TODO - messages and make it multilanguage
        $type = UserType::findOrFail($id);

        try {
            $type->update($request->validated());
        } catch (\Throwable $th) {

            $message = 'افزودن نوع کاربر به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'ویرایش نوع کاربر با موفقیت انجام شد';
        return response([
            'message' => $msg,
            'data' => $type
        ]);
    }

    public function destroy(int $id)
    {
        // TODO - messages and make it multilanguage
        // TODO - what about it's gifts !!?
        $type = UserType::findOrFail($id);

        try {
            $type->delete();
        } catch (\Throwable $th) {
            $message = 'حذف نوع کاربر به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'حذف نوع کاربر با موفقیت انجام شد';
        return response([
            'message' => $msg
        ]);
    }

    public function typeAssign(TypeAssignRequest $request)
    {
        // TODO - messages and make it multilanguage
        $user = User::findOrFail($request->user_id);
        try {
            $user->update([
                'type_id' => $request->type_id
            ]);
        } catch (\Throwable $th) {
            $message = 'تعیین نوع کاربر به درستی انجام نشد';
            return new ErrorResponse($th, $message);
        }

        $msg = 'تعیین نوع کاربر با موفقیت انجام شد';
        return response([
            'message' => $msg
        ]);
    }
}
