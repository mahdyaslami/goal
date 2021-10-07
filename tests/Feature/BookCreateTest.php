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

    /** @depends test_show_create_book_form */
    public function test_it_has_link_to_all_books_page($response)
    {
        $this->assertHasLink($response, '/books');
    }
}
