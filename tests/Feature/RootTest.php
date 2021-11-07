<?php

namespace Tests\Feature;

use Tests\TestCase;

class RootTest extends TestCase
{
    public function test_root_redirect_to_books()
    {
        $this->get('/')
            ->assertRedirect('/books');
    }
}
