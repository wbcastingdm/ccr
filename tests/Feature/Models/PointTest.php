<?php

namespace Tests\Feature\Models;

use App\Models\Point;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointTest extends TestCase
{
    use RefreshDatabase;
    use TestingHelper;
    /**
     * A basic feature test example.
     */


    protected function model(): Model
    {
        return new Point();
    }
}
