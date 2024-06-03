<?php

namespace App\Facade;

use App\Http\Responses\ErrorResponse;
use App\Models\Level;
use App\Models\Point;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

class Club
{

    /**
     * Add point proccess
     */
    public function addPoint(string $phone, int $type_id, string $subject, int $point)
    {
        $user = User::where('phone', $phone)->first();

        // if user is not exists create new one
        if (!$user) {
            $result = $this->createUser($phone, $type_id);
            if ($result instanceof Throwable) {
                return new ErrorResponse($user, 'کاربر با موفقیت ثبت نام نشد');
            }

            $user = $result;
        }

        DB::beginTransaction();

        try {
            // add to points history
            $user->pointsHistory()->create([
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

        $message = 'امتیاز با موفقیت ثبت گردید';
        return response([
            'message' => $message
        ]);
    }

    /**
     * Check user level after taken points
     */
    private function checkLevel(int $point)
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

    /**
     * Create user when user is not exists in database
     */
    private function createUser(string $phone, int $type_id)
    {
        try {
            $user = User::create(compact('phone', 'type_id'));
        } catch (\Throwable $th) {
            return $th;
        }
        return $user;
    }
}
