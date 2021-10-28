<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookStoreTest extends TestCase
{
    use HasBookRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rawBook = Book::factory()->raw();

        $this->body = array_merge(['step_count' => 0], $this->rawBook);
    }

    public function test_store_book()
    {
        $this->body['step_count'] = 5;

        $this->request($this->body)
            ->assertRedirect('/books');

        $this->assertDatabaseHas('books', $this->rawBook);
        $this->assertDatabaseCount('steps', 5);
    }

    public function test_step_count_is_required()
    {
        $this->assertValidationFail('step_count', '');
    }

    public function test_step_count_is_integer()
    {
        $this->assertValidationFail('step_count', 'not-a-number');
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
        $this->body[$key] = $value;

        $response = $this->request($this->body);

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
