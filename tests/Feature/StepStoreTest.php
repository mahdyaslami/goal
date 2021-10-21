<?php

namespace Tests\Feature;

use Tests\TestCase;

class StepStoreTest extends TestCase
{
    public function test_store_step()
    {
        $this->post('/steps', [
            'index' => 1,
            'description' => 'des'
        ])->assertStatus(200);

        $this->assertDatabaseHas('steps', [
            'index' => 1,
            'description' => 'des'
        ]);
    }
}
