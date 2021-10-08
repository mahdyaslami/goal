<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class BookCreateTest extends TestCase
{
    public function test_show_create_book_page()
    {
        return $this->get('/books/create')
            ->assertOk()
            ->assertViewIs('books.create');
    }

    /** @depends test_show_create_book_page */
    public function test_it_has_input_for_title($response)
    {
        $this->assertDomHasInput($response, 'text', 'title', [
            'maxlength' => 255,
            'require' => 'require'
        ]);
    }

    /** @depends test_show_create_book_page */
    public function test_it_has_input_for_page_count($response)
    {
        $this->assertDomHasInput($response, 'number', 'page_count', [
            'min' => 1,
            'max' => 1000,
            'require' => 'require'
        ]);
    }

    /** @depends test_show_create_book_page */
    public function test_it_has_link_to_all_books_page($response)
    {
        $this->assertDomHasLink($response, '/books');
    }
}
