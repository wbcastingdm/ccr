<?php

namespace Webcasting\Club\Facade;

use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Webcasting\Club\Responses\ErrorResponse;

class Club
{
    public function addPoint(string $subject, int $point)
    {
        $user = auth()->user();
        try {
            DB::beginTransaction();

            Point::create([
                'subject' => $subject,
                'point' => $point
            ]);

            $user->update([
                'balance' => $user->balance + $point
            ]);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = 'خطایی در عملیات رخ داد'; // TODO - change message and make it multi-language
            return new ErrorResponse($th, $message);
        }

        return true;
    }
}
