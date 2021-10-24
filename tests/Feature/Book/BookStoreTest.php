<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class BookStoreTest extends TestCase
{
    use RefreshDatabase,
        HasBookRequest;

    public function test_store_book()
    {
        $book = Book::factory()->raw();
        $body = array_merge(['step_count' => 5], $book);

        $this->request($body)
            ->assertRedirect('/books');

        $this->assertDatabaseHas('books', $book);
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
        $body = Book::factory()->raw([
            'step_count' => 0
        ]);

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
