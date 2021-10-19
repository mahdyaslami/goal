<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class BookUpdateTest extends TestCase
{
    use RefreshDatabase,
        HasBookRequest;

    public function test_update_book()
    {
        $book = Book::factory()->create();

        $body = Arr::only($book->toArray(), ['title', 'page_count']);

        $this->request($book->id, $body)
            ->assertRedirect('/books');
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

        $body = Arr::only($book->toArray(), ['title', 'page_count']);

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
