<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookUpdateTest extends TestCase
{
    use HasBookRequest;

    public function test_it_update_a_book()
    {
        $book = Book::factory()->create();

        $body = Book::factory()->raw();

        $this->request($book->id, $body)
            ->assertRedirect('/books');

        $this->assertDatabaseHas('books', $body);
    }

    protected function assertValidationOk($key, $value)
    {
        $this->assertValidation($key, $value, false);
    }

    protected function assertValidationFail($key, $value)
    {
        $this->assertValidation($key, $value);
    }

    protected function assertValidation($key, $value, $fail = true)
    {
        $book = Book::factory()->create();

        $body = Book::factory()->raw();

        $body[$key] = $value;

        $response = $this->request($book->id, $body);

        if ($fail) {
            $response->assertSessionHasErrors($key);
        } else {
            $response->assertSessionHasNoErrors();
        }
    }

    protected function request($bookId, $body)
    {
        return $this->put("/books/{$bookId}", $body);
    }
}
