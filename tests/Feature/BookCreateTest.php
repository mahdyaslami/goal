<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookCreateTest extends TestCase
{
    public function test_show_create_book_form()
    {
        $this->get('/books/create')
            ->assertOk();
    }
}
