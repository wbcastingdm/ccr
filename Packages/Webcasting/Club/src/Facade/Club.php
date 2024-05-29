<?php

namespace Webcasting\Club\Facade;

use App\Models\Point;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Webcasting\Club\Responses\ErrorResponse;

class Club
{
    public function addPoint(string $subject, int $point)
    {
        // Check user is logged in
        $user = auth()->user();

        if (!$user) {
            throw new AuthenticationException();
        }

        DB::beginTransaction();

        try {
            // add to points history
            Point::create([
                'subject' => $subject,
                'point' => $point
            ]);

            // add point
            $user->update([
                'balance' => $user->balance + $point
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = 'خطایی در عملیات رخ داد'; // TODO - change message and make it multi-language
            return new ErrorResponse($th, $message);
        }
        return 'ok';
    }
}
