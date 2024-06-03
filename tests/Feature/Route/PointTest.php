<?php

namespace Tests\Feature\Route;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointTest extends TestCase
{
    // use RefreshDatabase;

    public function test_add_point_for_new_user(): void
    {
        $user = User::factory()->make();
        $data = [
            'phone' => $user->phone,
            'type_id' => $user->type_id,
            'subject' => 'یه موضوعی',
            'point' => 50
        ];

        $response = $this->post('/api/add_point', $data);

        $response->assertStatus(200);
    }

    public function test_add_point_for_existing_user(): void
    {
        $user = User::factory()->create();
        $data = [
            'phone' => $user->phone,
            'type_id' => $user->type_id,
            'subject' => 'یه موضوعی',
            'point' => 50
        ];

        $response = $this->post('/api/add_point', $data);

        $response->assertStatus(200);
    }
}
