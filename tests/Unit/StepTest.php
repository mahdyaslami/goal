<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Step;
use Tests\TestCase;

class StepTest extends TestCase
{
    public function test_it_belong_to_a_book()
    {
        $step = Step::factory()->create();

        $this->assertInstanceOf(
            Book::class,
            $step->book
        );
    }

    public function test_it_get_path()
    {
        $step = Step::factory()->create();

        $this->assertEquals(
            route('step-update', ['step' => $step->id]),
            $step->path()
        );
    }
}
