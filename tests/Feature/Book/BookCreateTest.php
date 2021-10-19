<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class BookCreateTest extends TestCase
{
    use HasBookFormAssertion;

    public function test_show_create_book_page()
    {
        $response = $this->get('/books/create')
            ->assertOk()
            ->assertViewIs('books.create');

        $this->assertHasCreateFormForBook($response);
        $this->assertHasInputForTitle($response);
        $this->assertHasInputForPageCount($response);
        $this->assertHasLinkToAllBooksPage($response);

        return $response;
    }
}
