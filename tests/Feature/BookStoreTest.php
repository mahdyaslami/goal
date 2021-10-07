<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_create_book()
    {
        $body = Book::factory()->raw();

        $this->request($body)
            ->assertCreated();
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

    public function assertValidationOk($key, $value)
    {
        $body = Book::factory()->raw();

        $body[$key] = $value;

        $this->request($body)
            ->assertCreated();
    }

    public function assertValidationFail($key, $value)
    {
        $body = Book::factory()->raw();

        $body[$key] = $value;

        $this->request($body)
            ->assertSessionHasErrors($key);
    }

    public function request($body)
    {
        return $this->post('/books', $body);
    }
}
