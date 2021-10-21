<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StepStoreTest extends TestCase
{
    public function test_store_step()
    {
        $this->post('/steps', [
            'index',
            'description'
        ])->assertStatus(200);
    }
}
