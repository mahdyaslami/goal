<?php

namespace Tests\Feature;

use App\Models\Book;
use Tests\TestCase;

class BookIndexTest extends TestCase
{
    public function test_show_all_books()
    {
        $book = Book::factory()->create();

        $this->get('/books')
            ->assertOk()
            ->assertSee($book->title);
    }
}
