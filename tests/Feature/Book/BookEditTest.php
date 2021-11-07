<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookEditTest extends TestCase
{
    use HasBookForm;

    public function setUp(): void
    {
        parent::setUp();

        $this->book = Book::factory()->create();
        $this->response = $this->get($this->book->pathToEdit());
    }

    public function test_show_edit_book_page()
    {
        $this->response
            ->assertOk()
            ->assertViewIs('books.edit');
    }

    /** @depends test_show_edit_book_page */
    public function test_it_has_form()
    {
        $this->assertDomHasTag($this->response, 'form', [
            'action' => $this->book->path(),
            'method' => 'POST'
        ]);

        $this->assertDomHasInput($this->response, 'hidden', '_method', [
            'value' => 'PUT'
        ]);
    }

    /** @depends test_show_edit_book_page */
    public function test_show_book_created_message()
    {
        $this->response->assertSee('Book created.');
    }
}
