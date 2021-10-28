<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookEditTest extends TestCase
{
    use HasBookForm;

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
    public function test_it_has_form($args)
    {
        extract($args);

        $this->assertDomHasTag($response, 'form', [
            'action' => $book->path(),
            'method' => 'POST'
        ]);

        $this->assertDomHasInput($response, 'hidden', '_method', [
            'value' => 'PUT'
        ]);

        return $args;
    }
}
