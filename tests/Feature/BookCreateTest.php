<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookCreateTest extends TestCase
{
    public function test_show_create_book_form()
    {
        return $this->get('/books/create')
            ->assertOk()
            ->assertViewIs('books.create');
    }
}
