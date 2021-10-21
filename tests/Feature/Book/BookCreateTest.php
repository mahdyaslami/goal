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
    protected function test_has_form($response)
    {
        $this->assertDomHasTag($response, 'form', [
            'action' => '/books',
            'method' => 'POST'
        ]);

        return [
            'response' => $response
        ];
    }
}
