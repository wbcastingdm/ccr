<?php

namespace Tests\Feature\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait TestingHelper
{
    /**
     * A basic feature test example.
     */
    public function test_insert_data(): void
    {
        $model = $this->model();
        $data = $model::factory()->make()->toArray();
        $tableName = $model->getTable();
        $model::create($data);

        $this->assertDatabaseHas($tableName, $data);
    }

    abstract protected function model(): Model;
}
