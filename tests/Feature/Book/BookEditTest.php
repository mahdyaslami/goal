<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookEditTest extends TestCase
{
    public function test_show_edit_book_page()
    {
        $book = Book::factory()->create();

        $this->get($book->pathToEdit())
            ->assertOk()
            ->assertViewIs('books.edit');
    }
}
