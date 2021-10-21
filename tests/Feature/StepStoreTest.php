<?php

namespace Tests\Feature;

use App\Models\Step;
use Tests\TestCase;

class StepStoreTest extends TestCase
{
    public function test_store_step()
    {
        $body = Step::factory()->raw();

        $this->post('/steps', $body)
            ->assertStatus(200);

        $this->assertDatabaseHas('steps', $body);
    }
}
