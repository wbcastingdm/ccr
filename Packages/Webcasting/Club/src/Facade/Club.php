<?php

namespace Webcasting\Club\Facade;

use App\Models\Level;
use App\Models\Point;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Webcasting\Club\Http\Responses\ErrorResponse;

class Club
{
    public function addPoint(string $subject, int $point)
    {

        // Check user is logged in
        $user = auth()->user();

        if (!$user) {
            // throw new AuthenticationException();
            $user = auth()->loginUsingId(1);
        }

        DB::beginTransaction();

        try {
            // add to points history
            Point::create([
                'subject' => $subject,
                'point' => $point
            ]);

            $level = $this->checkLevel($user->balance + $point);

            $user->update([
                'balance' => $user->balance + $point,
                'level_id' => $level ? $level->id : null
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $message = 'خطایی در عملیات رخ داد'; // TODO - change message and make it multi-language
            return new ErrorResponse($th, $message);
        }
        return true;
    }

    private function checkLevel($point)
    {
        if (Cache::has('levels')) {
            $levels = Cache::get('levels');
        } else {
            $levels = Level::orderBy('required_points', 'DESC')->get();
            Cache::forever('levels', $levels);
        }

        foreach ($levels as $level) {
            if ($point >= $level->required_points) {
                return $level;
            }
        }
        return null;
    }
}
