<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_book()
    {
        $body = Book::factory()->raw();

        $this->request($body)
            ->assertRedirect('/books');
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
            ->assertSessionHasNoErrors();
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
