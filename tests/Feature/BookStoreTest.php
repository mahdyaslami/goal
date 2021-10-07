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
        $body = Book::factory()->raw();

        $body[$key] = $value;

        $response = $this->request($body);

        if ($fail) {
            $response->assertSessionHasErrors($key);
        } else {
            $response->assertSessionHasNoErrors();
        }
    }

    protected function request($body)
    {
        return $this->post('/books', $body);
    }
}
