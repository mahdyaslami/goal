<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class BookCreateTest extends TestCase
{
    use HasBookForm;

    public function setUp(): void
    {
        parent::setUp();

        $this->response = $this->get('/books/create');
        $this->book = null;
    }

    public function test_show_create_book_page()
    {
        $this->response
            ->assertOk()
            ->assertViewIs('books.create');
    }

    /** @depends test_show_create_book_page */
    public function test_it_has_form()
    {
        $this->assertDomHasTag($this->response, 'form', [
            'action' => '/books',
            'method' => 'POST'
        ]);
    }

    /** @depends test_it_has_form */
    public function test_it_has_input_for_step_count()
    {
        $this->assertDomHasInput($this->response, 'number', 'step_count', [
            'min' => 1,
            'max' => 100,
            'require' => 'require'
        ]);
    }
}
