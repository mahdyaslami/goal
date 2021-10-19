<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_it_get_edit_route()
    {
        $book = Book::factory()->create();

        $this->assertEquals(
            route('book-edit', ['book' => $book->id]),
            $book->pathToEdit()
        );
    }

    public function test_it_get_update()
    {
        $book = Book::factory()->create();

        $this->assertEquals(
            route('book-update', ['book' => $book->id]),
            $book->pathToUpdate()
        );
    }
}
