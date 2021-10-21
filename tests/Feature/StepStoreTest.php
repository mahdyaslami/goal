<?php

namespace Tests\Feature;

use App\Models\Step;
use Tests\TestCase;

class StepStoreTest extends TestCase
{
    public function test_store_step()
    {
        $body = Step::factory()->raw();

        $this->request($body)
            ->assertStatus(200);

        $this->assertDatabaseHas('steps', $body);
    }

    public function test_index_is_required()
    {
        $this->assertValidationFail('index', '');
    }

    public function test_description_is_required()
    {
        $this->assertValidationFail('description', '');
    }

    public function assertValidationFail($key, $value)
    {
        $body = Step::factory()->raw();

        $body[$key] = $value;

        $this->request($body)
            ->assertSessionHasErrors($key);
    }

    protected function request($body)
    {
        return $this->post('/steps', $body);
    }
}
