<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Point;
use App\Models\UserType;
use App\Services\YourService; // Adjust the namespace accordingly
use Webcasting\Club\Facade\ClubFacade;
use Webcasting\Club\Responses\ErrorResponse;

class AddPointTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // You might need to set up some initial state or data here
    }

    public function test_add_point_user_not_logged_in()
    {
        // Mock the Auth facade to return null, simulating a non-authenticated user
        Auth::shouldReceive('user')->once()->andReturn(null);

        // Expect the method to throw an AuthenticationException
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);

        // Perform the action
        $subject = 'Test Subject';
        $point = 10;

        // Assuming YourService is the class where addPoint method resides
        ClubFacade::addPoint($subject, $point);

        $this->assertDatabaseMissing('points', [
            'subject' => $subject,
            'point' => $point
        ]);
    }

    public function test_add_point_successful_transaction()
    {
        UserType::create([
            'name' => 'عادی'
        ]);
        // Mock the Auth facade to return a user
        $user = User::factory()->create(['balance' => 0, 'type_id' => 0]);
        Auth::shouldReceive('user')->once()->andReturn($user);

        // Perform the action
        $subject = 'Test Subject';
        $point = 10;

        // Assuming YourService is the class where addPoint method resides
        $response = ClubFacade::addPoint($subject, $point);
        // Assert the response
        $this->assertEquals('ok', $response);

        // Assert the database has the point
        $this->assertDatabaseHas('points', [
            'subject' => $subject,
            'point' => $point
        ]);

        // Assert the user's balance has been updated
        $this->assertEquals($user->fresh()->balance, $point);
    }

    // TODO Fix transaction failure test has problem
    // public function test_add_point_transaction_failure()
    // {
    //     // Mock the Auth facade to return a user
    //     $user = User::factory()->create(['balance' => 0]);
    //     Auth::shouldReceive('user')->once()->andReturn($user);

    //     // Mock the DB facade to throw an exception on commit
    //     DB::shouldReceive('beginTransaction')->once();
    //     DB::shouldReceive('commit')->once()->andThrow(new \Exception('Test Exception'));
    //     DB::shouldReceive('rollBack')->once();

    //     // Perform the action
    //     $subject = 'Test Subject';
    //     $point = 10;

    //     // Assuming YourService is the class where addPoint method resides
    //     $response = ClubFacade::addPoint($subject, $point);

    //     $this->assertDatabaseMissing('points', [
    //         'subject' => $subject,
    //         'point' => $point
    //     ]);

    //     $this->assertEquals($user->fresh()->balance, 0);

    //     // Assert the response is an instance of ErrorResponse
    //     $this->assertInstanceOf(ErrorResponse::class, $response);
    //     $this->assertEquals('خطایی در عملیات رخ داد', $response->message);
    // }
}
