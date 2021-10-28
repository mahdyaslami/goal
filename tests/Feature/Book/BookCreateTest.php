<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class BookCreateTest extends TestCase
{
    use HasBookForm;

    public function test_show_create_book_page()
    {
        $response = $this->get('/books/create')
            ->assertOk()
            ->assertViewIs('books.create');

        return $response;
    }

    /** @depends test_show_create_book_page */
    public function test_it_has_form($response)
    {
        $this->assertDomHasTag($response, 'form', [
            'action' => '/books',
            'method' => 'POST'
        ]);

        return [
            'response' => $response,
            'book' => null
        ];
    }

    /** @depends test_it_has_form */
    public function test_it_has_input_for_step_count($args)
    {
        extract($args);

        $this->assertDomHasInput($response, 'number', 'step_count', [
            'min' => 1,
            'max' => 100,
            'require' => 'require'
        ]);
    }
}
