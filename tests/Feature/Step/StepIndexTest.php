<?php

namespace Tests\Feature\Step;

use App\Models\Book;
use Tests\TestCase;

class StepStepIndexTest extends TestCase
{
    public function test_show_steps_per_book()
    {
        $book = Book::factory()->hasSteps(5)->create();

        $this->get("/books/{$book->id}/steps")
            ->assertOk();
    }
}
