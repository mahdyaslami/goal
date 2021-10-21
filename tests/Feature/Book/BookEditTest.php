<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookEditTest extends TestCase
{
    use RefreshDatabase, HasBookForm;

    public function test_show_edit_book_page()
    {
        $book = Book::factory()->create();

        $response = $this->get($book->pathToEdit())
            ->assertOk()
            ->assertViewIs('books.edit');

        return [
            'response' => $response,
            'book' => $book,
        ];
    }

    /** @depends test_show_edit_book_page*/
    protected function test_has_from($args)
    {
        extract($args);

        $this->assertDomHasTag($response, 'form', [
            'action' => $book->pathToUpdate(),
            'method' => 'POST'
        ]);

        $this->assertDomHasInput($response, 'hidden', '_method', [
            'value' => 'PUT'
        ]);

        return $args;
    }
}
