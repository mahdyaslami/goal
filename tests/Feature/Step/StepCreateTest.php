<?php

namespace Tests\Feature\Step;

use Tests\TestCase;

class StepCreateTest extends TestCase
{
    public function test_show_create_step_page()
    {
        $this->get('/steps/create')
            ->assertOk();
    }
}
