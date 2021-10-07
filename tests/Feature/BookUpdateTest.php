<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_book()
    {
        $book = Book::factory()->create();

        $body = Arr::only($book->toArray(), ['title', 'page_count']);

        $this->request($book->id, $body)
            ->assertOk();
    }

    public function test_title_is_required()
    {
        $this->assertValidationFail('title', '');
    }

    public function test_title_should_be_shorter_than_256()
    {
        $this->assertValidationFail('title', Str::random(256));
    }

    public function test_title_should_be_at_least_255()
    {
        $this->assertValidationOk('title', Str::random(255));
    }

    protected function assertValidationOk($key, $value)
    {
        $this->assertValidate($key, $value, false);
    }

    protected function assertValidationFail($key, $value)
    {
        $this->assertValidate($key, $value);
    }

    protected function assertValidate($key, $value, $fail = true)
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
