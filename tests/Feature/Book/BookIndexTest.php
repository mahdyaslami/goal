<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->book = Book::factory()->create();
        $this->response = $this->get('/books');
    }

    public function test_show_all_books()
    {
        $this->get('/books')
            ->assertOk()
            ->assertSee([
                $this->book->title,
                $this->book->page_count,
                $this->book->step_count
            ]);
    }

    /** @depends test_show_all_books */
    public function test_it_has_link_to_create_book_page()
    {
        $this->assertDomHasLink($this->response, '/books/create');
    }

    /** @depends test_show_all_books */
    public function test_it_has_link_to_edit_book()
    {
        $this->assertDomHasLink($this->response, $this->book->pathToEdit());
    }
}
