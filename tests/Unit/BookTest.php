<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_it_get_path_to_edit()
    {
        $book = Book::factory()->create();

        $this->assertEquals(
            route('book-edit', ['book' => $book->id]),
            $book->pathToEdit()
        );
    }

    public function test_it_get_path_to_update()
    {
        $book = Book::factory()->create();

        $this->assertEquals(
            route('book-update', ['book' => $book->id]),
            $book->path()
        );
    }

    public function test_it_has_many_steps()
    {
        $book = Book::factory()->create();

        $this->assertInstanceOf(
            Collection::class,
            $book->steps
        );
    }

    public function test_it_can_create_many_steps()
    {
        $book = Book::factory()->create([
            'page_count' => 10
        ]);

        $steps = $book->createSteps(2);

        $this->assertEquals(
            'To page 5.',
            $steps[0]->description
        );

        $this->assertEquals(
            'To page 10.',
            $steps[1]->description
        );
    }
}
