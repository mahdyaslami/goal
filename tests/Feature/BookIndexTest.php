<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_all_books()
    {
        $book = Book::factory()->create();

        return $this->get('/books')
            ->assertOk()
            ->assertSee($book->title);
    }

    /** @depends test_show_all_books */
    public function test_it_has_link_to_create_book_page($response)
    {
        $this->assertDomHasLink($response, '/books/create');
    }
}
