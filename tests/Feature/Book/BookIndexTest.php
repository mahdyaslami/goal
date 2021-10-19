<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_all_books()
    {
        $book = Book::factory()->create();

        $response = $this->get('/books')
            ->assertOk()
            ->assertSee($book->title);

        return [$response, $book];
    }

    /** @depends test_show_all_books */
    public function test_it_has_link_to_create_book_page($args)
    {
        $response = $args[0];
        $this->assertDomHasLink($response, '/books/create');
    }

    /** @depends test_show_all_books */
    public function test_it_has_link_to_edit_book($args)
    {
        $response = $args[0];
        $book = $args[1];

        $this->assertDomHasLink($response, $book->pathToEdit());
    }
}
