<?php

namespace Tests\Feature;

use App\Models\Book;
use Tests\TestCase;

class StepTest extends TestCase
{
    public function test_description_is_required()
    {
        $book = Book::factory()->hasSteps()->create();
        $step = $book->steps()->first();

        $this->put("/steps/{$step->id}", [
            'description' => ''
        ])->assertSessionHasErrors('description');
    }
}
