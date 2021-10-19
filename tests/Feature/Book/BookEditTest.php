<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookEditTest extends TestCase
{
    use RefreshDatabase;
    use HasBookFormAssertion;

    public function test_show_edit_book_page()
    {
        $book = Book::factory()->create();

        $response = $this->get($book->pathToEdit())
            ->assertOk()
            ->assertViewIs('books.edit');

        $this->assertHasEditFormForBook($response, $book);
        $this->assertHasInputForTitle($response, $book);
        $this->assertHasInputForPageCount($response, $book);
    }
}
